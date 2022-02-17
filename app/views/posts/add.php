<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<section class="container">
    <h1>Tạo mới tin tức</h1>
    <br>
    <form class="container bg-secondary py-5 px-5" method="POST" action="/posts/store" style="width:100%;"
          enctype="multipart/form-data">
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
            <label for="">Tiêu đề tin tức</label>
            <input type="text" name="title" class="form-control" id="">
        </div>
        <br>
        <div class="form-group">
            <label for="">Chuyên mục</label>
            <select name="category_id" id="" class="form-control">
                <?php if (isset($categories) && count($categories) > 0) { ?>
                    <?php foreach ($categories as $item) { ?>
                        <option value="<?= $item['id']; ?>"><?= $item['name']; ?></option>
                    <?php } ?>
                <?php } ?>
            </select>
        </div>
        <br>
        <div class="form-group">
            <label for="">Nội dung giới thiệu</label>
            <textarea name="sort_description" rows="4" class="form-control"></textarea>
        </div>
        <br>
        <div class="form-group">
            <label for="">Nội dung tin tức</label>
            <textarea name="content" rows="10" class="form-control"></textarea>
        </div>
        <br>
        <div class="form-group">
            <label for="">Ảnh đại diện</label>
            <input type="file" name="image_url" id="">
        </div>
        <br>
        <div style="display:flex; justify-content: space-between;">
            <button type="submit" class="btn btn-success" style="width: 30%">Tạo mới</button>
            <a href="/posts" class="btn btn-primary" style="width: 30%">Trở về</a>
        </div>
        <br>
    </form>
</section>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content');
</script>