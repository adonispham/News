<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<!-- Page Content -->
<div class="container">
    <div class="space20"></div>
    <div class="row main-left">
        <div class="col-md-3 ">
            <ul class="list-group" id="menu">
                <li href="#" class="list-group-item menu1 active">
                    Chuyên mục tin tức
                </li>
            </ul>
        </div>

        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#337AB7; color:white;">
                    <h2 style="margin-top:0px; margin-bottom:0px;"> Tin Tức</h2>
                </div>
                <div class="panel-body">
                    <form class="form-inline my-2 my-lg-0" id="form-search" style="text-align: right;" method="GET"
                          action="/?search=">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"
                               name="search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                    <table id="panel-body" style="width:100%;">

                    </table>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination" id="pagination"></ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- end Page Content -->

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
<script>
    $(document).ready(function () {
        // set categories
        $.ajax({
            type: "GET",
            url: "/api/v1/category",
            data: [],
            success: function (response) {
                if (response.length > 0) {
                    $(response).each(function (index) {
                        let html = '<li class="list-group-item menu1"><a href="/category/' + response[index]['id'] + '">' + response[index]['name'] + '</a></li>';
                        $('ul#menu > li.active').after(html)
                    })
                } else {
                    let html = '<li class="list-group-item menu1">Đang cập nhật</li>';
                    $('ul#menu > li.active').after(html)
                }
            }
        });

        <?php if (isset($_SESSION['filter']['category'])) { ?>
        var urlGetPost = "/api/v1/category/<?= $_SESSION['filter']['category'] ?>/post"
        <?php unset($_SESSION['filter']['category']); ?>
        <?php } else { ?>
        var urlGetPost = "/api/v1/posts";
        <?php } ?>
        // set posts
        var url_string = window.location.href;
        var url = new URL(url_string);
        var page = url.searchParams.get("page") ?? 1;
        var search = url.searchParams.get("search") ?? "";
        $.ajax({
            type: "GET",
            url: urlGetPost,
            data: {
                page: page,
                search: search,
            },
            success: function (data) {
                var posts = data.data;
                if (posts.length > 0) {
                    let imageUrl = "/image/320x150.png";
                    if (posts['image_url'] != "") {
                        imageUrl = "/" + posts['image_url'];
                    }
                    $(posts).each(function (index) {
                        let imageUrl = "/image/320x150.png";
                        if (posts[index]['image_url'] != "") {
                            imageUrl = "/" + posts[index]['image_url'];
                        }
                        let html = '<tr><td><div class="row-item row">' +
                            '<h3><a href="/category/' + posts[index]['category_id'] + '">' + posts[index]['category_name'] + '</a> |' +
                            '<small><a><i> cập nhật: ' + posts[index]['updated_at'] + '</i></a></small></h3>' +
                            '<div class="col-md-12 border-right">' +
                            '<div class="col-md-3"><a href="/post/' + posts[index]['id'] + '"><img class="img-responsive" src="' + imageUrl + '" alt="" style="width:150px;height:150px;"></a></div>' +
                            '<div class="col-md-9"><h3>' + posts[index]['title'] + '</h3>' +
                            '<p>' + posts[index]['sort_description'] + '</p>' +
                            '<a class="btn btn-primary" href="/post/' + posts[index]['id'] + '">Xem tin tức<span class="glyphicon glyphicon-chevron-right"></span></a>' +
                            '</div>' +
                            '</div>' +
                            '<div class="break"></div>' +
                            '</div></td></tr>';
                        $('#panel-body').append(html);
                    })


                    if (data.total % 3 == 0) {
                        let paginate = (data.total - data.total % 3) / 3;
                        if (paginate > 1) {
                            for (let index = 0; index < paginate; index++) {
                                let page = index + 1;
                                let paginHtml = '<li class="page-item"><a class="page-link" href="?page=' + page + '">' + page + '</a></li>'
                                $('ul#pagination').append(paginHtml);
                            }
                        }
                    } else {
                        let paginate = (data.total - data.total % 3) / 3 + 1;
                        if (paginate > 1) {
                            for (let index = 0; index < paginate; index++) {
                                let page = index + 1;
                                let paginHtml = '<li class="page-item"><a class="page-link" href="?page=' + page + '">' + page + '</a></li>'
                                $('ul#pagination').append(paginHtml);
                            }
                        }
                    }
                } else {
                    let html = '<tr><td><div class="row-item row"><strong>Không có tin tức</strong></div></td></tr>';
                    $('#panel-body').append(html);
                }
            }

        });

        $('form#form-search').on('submit', function (e) {
            let search = $('input[name=search]').val();
            let newAction = $('form#form-search').attr('action') + '"' + search + '"';
            $('form#form-search').attr('action', newAction);
        })
    })
    // function template(data) {
    //     let imageUrl = "/image/320x150.png";
    //     if (data['image_url'] != "") {
    //         imageUrl = "/" + data['image_url'];
    //     }
    //     $(data).each(function (index) {
    //         let imageUrl = "/image/320x150.png";
    //         if (data[index]['image_url'] != "") {
    //             imageUrl = "/" + data[index]['image_url'];
    //         }
    //         let html = '<tr><td><div class="row-item row">' +
    //             '<h3><a href="/category/' + data[index]['category_id'] + '">' + data[index]['category_name'] + '</a> |' +
    //             '<small><a><i> cập nhật: ' + data[index]['updated_at'] + '</i></a></small></h3>' +
    //             '<div class="col-md-12 border-right">' +
    //             '<div class="col-md-3"><a href="/post/' + data[index]['id'] + '"><img class="img-responsive" src="' + imageUrl + '" alt="" style="width:150px;height:150px;"></a></div>' +
    //             '<div class="col-md-9"><h3>' + data[index]['title'] + '</h3>' +
    //             '<p>' + data[index]['sort_description'] + '</p>' +
    //             '<a class="btn btn-primary" href="/post/' + data[index]['id'] + '">Xem tin tức<span class="glyphicon glyphicon-chevron-right"></span></a>' +
    //             '</div>' +
    //             '</div>' +
    //             '<div class="break"></div>' +
    //             '</div></td></tr>';
    //         $('#panel-body').append(html);
    //     })
    // }
</script>