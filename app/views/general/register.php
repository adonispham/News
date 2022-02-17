<?php require_once __DIR__ . '/../layouts/header.php'; ?>

    <section class="vh-100 bg-secondary">
        <div class="container py-5 px-5 h-100" style="width: 30%; margin: auto;">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <form class="container bg-white py-5 px-5" method="POST" action="/register" style="width:100%;">
                    <?php if (isset($error)) { ?>
                        <div class="alert alert-danger">
                            <strong>Thông báo lỗi!</strong> <?= $error ?>
                        </div>
                    <?php } ?>
                    <h1>Đăng ký tài khoản</h1>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên tài khoản</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="username"
                               placeholder="Tên tài khoản">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Mật khẩu</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password"
                               placeholder="Mật khẩu">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary" style="width: 100%">Đăng ký</button>
                    <br>
                    <span>Bạn đã có tài khoản </span> <strong><a class="text-success" href="/login">Đăng nhập</a></strong>
                </form>
            </div>
        </div>
    </section>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>