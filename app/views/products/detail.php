<?php 
$img = !empty($product['image']) ? $product['image'] : 'no-img.png';
$imgPath = BASE_URL . '/uploads/products/' . $img;

// Fix NULL values
$description = $product['description'] ?? '';
$detail      = $product['detail'] ?? '';

// ===== GIẢM GIÁ =====
$price    = (float)($product['price'] ?? 0);
$discount = (float)($product['discount'] ?? 0);

if ($discount > 0) {
    $finalPrice = $price * (100 - $discount) / 100;
}
?>

<div class="container py-4">

    <!-- TOP PRODUCT AREA -->
    <div class="row mb-5 align-items-start">

        <!-- IMAGE -->
        <div class="col-md-5 text-center">
            <div class="bg-white shadow-sm rounded p-3 border position-relative">

                <?php if ($discount > 0): ?>
                    <span class="badge bg-danger position-absolute"
                          style="top:10px; left:10px; font-size:14px;">
                        -<?= $discount ?>%
                    </span>
                <?php endif; ?>

                <img src="<?= $imgPath ?>" 
                     alt="<?= htmlspecialchars($product['productname'] ?? '') ?>"
                     class="img-fluid rounded"
                     style="max-height:420px; object-fit:contain;"
                     onerror="this.src='<?= BASE_URL ?>/assets/images/no-image.png'">
            </div>
        </div>

        <!-- INFO -->
        <div class="col-md-7">

            <h2 class="fw-bold mb-2">
                <?= htmlspecialchars($product['productname'] ?? '') ?>
            </h2>

            <!-- PRICE -->
            <div class="mb-3">

                <?php if ($discount > 0): ?>
                    <div class="text-muted text-decoration-line-through fs-6">
                        <?= number_format($price) ?> ₫
                    </div>

                    <div class="text-danger fw-bold" style="font-size:32px;">
                        <?= number_format($finalPrice) ?> ₫
                    </div>

                    <div class="text-success small">
                        💰 Bạn tiết kiệm <?= number_format($price - $finalPrice) ?> ₫
                    </div>
                <?php else: ?>
                    <div class="text-danger fw-bold" style="font-size:32px;">
                        <?= number_format($price) ?> ₫
                    </div>
                <?php endif; ?>

            </div>

            <div class="small text-muted mb-3">
                ⭐ Sản phẩm bán chạy | 🚚 Giao nhanh 2h | 🛡 Bảo hành chính hãng
            </div>

            <!-- ADD TO CART -->
            <form action="<?= BASE_URL ?>/cart/add" method="post" class="mb-4">
                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">

                <div class="d-flex gap-3">
                    <input type="number" name="quantity" value="1" min="1"
                        class="form-control text-center"
                        style="max-width:90px; font-size:18px;">

                    <button class="btn btn-primary flex-fill py-2"
                            type="submit"
                            style="font-size:18px;">
                        🛒 Thêm vào giỏ hàng
                    </button>
                </div>
            </form>

            <!-- DESCRIPTION -->
            <div class="bg-light border rounded p-3 mb-4">
                <h5 class="fw-bold">Mô tả sản phẩm</h5>
                <p class="m-0 text-secondary">
                    <?= $description 
                        ? nl2br(htmlspecialchars($description)) 
                        : '<span class="text-muted">Chưa cập nhật</span>' ?>
                </p>
            </div>

            <!-- TECHNICAL -->
            <h5 class="fw-bold mb-2">Thông số kỹ thuật</h5>
            <div class="border rounded p-3 bg-white shadow-sm">
                <p class="m-0">
                    <?= $detail 
                        ? nl2br(htmlspecialchars($detail)) 
                        : '<span class="text-muted">Chưa có thông số kỹ thuật</span>' ?>
                </p>
            </div>

        </div>
    </div>

    <!-- COMMENTS SECTION -->
    <hr>
    <h4 class="fw-bold mb-3">💬 Đánh giá & bình luận</h4>

    <?php if (!empty($_SESSION['user'])): ?>

        <div class="border rounded p-3 bg-white shadow-sm mb-4">
            <form method="post">

                <label class="form-label fw-bold">Nội dung bình luận</label>
                <textarea name="content" class="form-control mb-3" rows="3"></textarea>

                <label class="form-label fw-bold">Chấm sao</label>
                <select name="rate" class="form-select mb-3" style="max-width:150px;">
                    <?php for ($i = 5; $i >= 1; $i--): ?>
                        <option value="<?= $i ?>"><?= $i ?> sao</option>
                    <?php endfor; ?>
                </select>

                <button class="btn btn-success px-4" type="submit">
                    Gửi đánh giá
                </button>
            </form>
        </div>

    <?php else: ?>

        <p class="alert alert-warning">
            Vui lòng <a href="<?= BASE_URL ?>/auth/login">Đăng nhập</a> để bình luận.
        </p>

    <?php endif; ?>

    <!-- SHOW COMMENTS -->
    <?php foreach ($comments as $c): ?>
        <div class="border rounded p-3 mb-3 bg-white shadow-sm">

            <div class="fw-bold">
                <?= htmlspecialchars($c['fullname'] ?? 'Người dùng') ?>
                <span class="text-warning">
                    <?= str_repeat('★', (int)($c['rate'] ?? 5)) ?>
                </span>
            </div>

            <p class="mt-1 mb-0 text-secondary">
                <?= !empty($c['content']) 
                    ? nl2br(htmlspecialchars($c['content'])) 
                    : '<span class="text-muted">Không có nội dung đánh giá</span>' ?>
            </p>

        </div>
    <?php endforeach; ?>

</div>
