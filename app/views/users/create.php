<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

    <section class="container">
        <h1>Tạo mới người dùng</h1>
        <br>
        <form class="container bg-secondary py-5 px-5" method="POST" action="/categories/store" style="width:100%;">
            <?php if (isset($error)) { ?>
                <div class="alert alert-danger">
                    <strong>Thông báo lỗi!</strong> <?= $error ?>
                </div>
                <br>
            <?php } ?>

            <?php if (isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger session">
                    <strong>Thông báo lỗi!</strong> <?= $_SESSION['error'] ?>
                </div>
                <br>
                <?php unset($_SESSION['error']); ?>
            <?php } ?>

            <div class="form-group">
                <label for="exampleInputEmail1">Tên chuyên mục</label>
                <input type="text" name="title" class="form-control" id="exampleInputEmail1"
                       placeholder="Nhập tên chuyên mục">
            </div>
            <br>
            <div class="form-group">
                <label for="exampleInputPassword1">Mô tả chuyên mục</label>
                <input type="text" name="description" class="form-control" id="exampleInputPassword1"
                       placeholder="Nhập mô tả chuyên mục">
            </div>
            <br>
            <div style="display:flex; justify-content: space-between;">
                <button type="submit" class="btn btn-success" style="width: 30%">Tạo mới</button>
                <a href="/categories" class="btn btn-primary" style="width: 30%">Trở về</a>
            </div>
            <br>
        </form>
    </section>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>