<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<?php
// session_start();
?>

    <section>
        <div class="container py-5 px-5 h-100" style="width: 30%; margin: auto;">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <form class="container bg-secondary py-5 px-5" method="POST" action="/login" style="width:100%;">
                    <?php if (isset($error)) { ?>
                        <div class="alert alert-danger">
                            <strong>Thông báo lỗi!</strong> <?= $error ?>
                        </div>
                    <?php } ?>

                    <h1>Đăng nhập hệ thống</h1>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên tài khoản</label>
                        <input type="text" name="username" class="form-control" id="exampleInputEmail1"
                               placeholder="Tên tài khoản">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Mật khẩu</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                               placeholder="Mật khẩu">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary" style="width: 100%">Đăng nhập</button>
                    <br>
                    <span>Bạn chưa có tài khoản </span> <strong><a class="text-success" href="/register">Đăng ký
                            ngay</a></strong>
                </form>
            </div>
        </div>
    </section>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>