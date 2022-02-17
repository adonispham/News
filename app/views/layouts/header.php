<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/shop-homepage.css" rel="stylesheet">
    <link href="/css/my.css" rel="stylesheet">
    <title>Website News</title>
</head>
<body>

<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) { ?>
                <a class="navbar-brand" href="/admin">Tin Tức - Trang quản trị</a>
            <?php } else { ?>
                <a class="navbar-brand" href="/">Tin Tức</a>
            <?php } ?>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <?php if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) { ?>
                <ul class="nav navbar-nav">
                    <li>
                        <a href="/">Trang chủ</a>
                    </li>
                    <li>
                        <a href="/categories">Chuyên mục</a>
                    </li>
                    <li>
                        <a href="/posts">Bài viết</a>
                    </li>
                    <!--                    <li>-->
                    <!--                        <a href="/users">Người dùng</a>-->
                    <!--                    </li>-->
                </ul>
            <?php } ?>
            <ul class="nav navbar-nav pull-right">
                <?php if (isset($_SESSION['isAuth']) && $_SESSION['isAuth'] == true) { ?>
                    <li>
                        <a>
                            <span class="glyphicon glyphicon-user"></span>
                            <?php if (isset($_SESSION['isAuth'])) { ?>
                                <?= $_SESSION['username']; ?>
                            <?php } else { ?>
                                Unknown User
                            <?php } ?>
                        </a>
                    </li>

                    <li>
                        <a href="/destroy">Đăng xuất</a>
                    </li>
                <?php } else { ?>
                    <li>
                        <a href="/register">Đăng ký</a>
                    </li>
                    <li>
                        <a href="/login">Đăng nhập</a>
                    </li>
                <?php } ?>
            </ul>
        </div>


        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
