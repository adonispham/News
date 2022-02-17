<?php require_once __DIR__ . '/../layouts/header.php'; ?>

    <section>
        <div class="container py-5 h-100">
            <br>
            <div class="card" style="background-color: #eee; padding: 3rem; border-radius: 10px;">
                <div class="card-header">
                    <h3>Chuyên mục tin tức</h3>
                </div>
                <div class="card-body">
                    <p class="card-text">Tổng số chuyên mục tin tức hiện tại:
                        <strong><?= count($categories) > 0 ? count($categories) : 0; ?></strong></p>
                    <a href="/categories" class="btn btn-primary">Tới trang quản lý chuyên mục</a>
                </div>
            </div>
            <br>
            <div class="card" style="background-color: #eee; padding: 3rem; border-radius: 10px;">
                <div class="card-header">
                    <h3>Bài viết / Tin tức</h3>
                </div>
                <div class="card-body">
                    <p class="card-text">Tổng số bài viết / tin tức hiện tại:
                        <strong><?= count($posts) > 0 ? count($posts) : 0; ?></strong></p>
                    <a href="/posts" class="btn btn-primary">Tới trang quản lý tin tức</a>
                </div>
            </div>
            <br>
        </div>
    </section>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>