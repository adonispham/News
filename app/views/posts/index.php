<?php require_once __DIR__ . '/../layouts/header.php'; ?>

    <section class="container">
        <h1>Danh sách các tin tức</h1>
        <br>
        <?php if (isset($error)) { ?>
            <div class="alert alert-danger">
                <strong>Thông báo lỗi!</strong> <?= $error ?>
            </div>
            <br>
        <?php } ?>
        <?php if (isset($success)) { ?>
            <div class="alert alert-success">
                <strong>Thông báo!</strong> <?= $success ?>
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
        <?php if (isset($_SESSION['success'])) { ?>
            <div class="alert alert-success session">
                <strong>Thông báo!</strong> <?= $_SESSION['success'] ?>
            </div>
            <br>
            <?php unset($_SESSION['success']); ?>
        <?php } ?>
        <a href="/posts/add" class="btn btn-primary">Tạo mới tin tức</a>
        <br>
        <table class="table table-hover" style="margin-top: 2rem;">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Ảnh đại diện</th>
                <th scope="col">Tiêu đề</th>
                <th scope="col">Chuyên mục</th>
                <th scope="col">Mô tả</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <?php if (isset($posts) && count($posts) > 0) { ?>
                <?php $index = 1; ?>
                <?php foreach ($posts as $item) { ?>
                    <tr>
                        <th scope="row"><?= $index ?></th>
                        <td>
                            <img src="<?= $item['image_url'] ?>" alt="" srcset="" style="width: 150px;">
                        </td>
                        <td><?= $item['title'] ?></td>
                        <td width="10%"><?= $categories[$item['category_id']] ?></td>
                        <td><?= $item['sort_description'] ?></td>
                        <td>
                            <div style="display:flex;">
                                <a href="/posts/edit?id=<?= $item['id'] ?>" class="btn btn-warning">Cập nhật</a>
                                <form action="/posts/delete" method="POST">
                                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                    <button type="submit" class="btn btn-danger">Xoá</button>
                                </form>
                            </div>
                        </td>
                        <?php $index++; ?>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="6">
                        <div class="text-center">Không có dữ liệu</div>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </section>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>