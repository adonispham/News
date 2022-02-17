<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Blog Sidebar Widgets Column -->
        <div class="col-md-3">
            <ul class="list-group" id="menu">
                <li href="#" class="list-group-item menu1 active">
                    Chuyên mục tin tức
                </li>
            </ul>
        </div>
        <!-- Blog Post Content Column -->
        <div class="col-lg-9">

            <!-- Blog Post -->

            <!-- Title -->
            <h1 id="post-title">Blog Post Title</h1>

            <!-- Author -->
            <p class="lead" id="post-category">
                <a>Start Bootstrap</a>
            </p>

            <!-- Preview Image -->
            <img class="img-responsive" id="post-image" src="http://placehold.it/900x300" alt=""
                 style="width: 900px; height:540px;">

            <!-- Date/Time -->
            <p><span class="glyphicon glyphicon-time"></span> <span id="post-updated">Posted on August 24, 2013 at 9:00 PM</span>
            </p>
            <hr>

            <!-- Post Content -->
            <p class="lead" id="post-description"></p>
            <p id="post-content"></p>

            <hr>

            <!-- Blog Comments -->

            <!-- Comments Form -->
            <div class="well">
                <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                <form role="form" id="post-form-comment" action="" method="POST">
                    <div class="form-group">
                        <textarea class="form-control" rows="3" name="comment"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Gửi</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->

            <!-- Comment -->
            <?php if (isset($comments) && count($comments) > 0) { ?>
                <div id="comment" style="padding-bottom: 5rem;">
                    <h2>Bình luận</h2>
                    <?php foreach ($comments as $item) { ?>
                        <div class="media">
                            <div class="media-body">
                                <h4 class="media-heading"><?= $item['username'] ?>
                                    <small><?= $item['created_at'] ?></small>
                                </h4>
                                <?= $item['comment'] ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
            <br>
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

        <?php if (isset($_SESSION['filter']['post'])) { ?>
        var urlGetPost = "/api/v1/posts/<?= $_SESSION['filter']['post'] ?>"
        <?php unset($_SESSION['filter']['post']); ?>
        <?php } else { ?>
        window.location.href = "/";
        <?php } ?>
        // set posts
        $.ajax({
            type: "GET",
            url: urlGetPost,
            data: [],
            success: function (response) {
                $('#post-title').text(response['title'])
                $('#post-category > a').text(response['category_name'])
                if (response['image_url'] != "") {
                    $('#post-image').attr("src", "/" + response['image_url'])
                }
                $('span#post-updated').text(response['updated_at'])
                $('#post-description').text(response['sort_description'])
                $('#post-content').html(response['content'])
                $('#post-form-comment').attr("action", "/post/" + response['id'] + "/comment")
            },
            error: function () {
                window.location.href = "/";
            }
        });
    })
</script>