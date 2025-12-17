<div class="row g-4">

<?php foreach ($hotProducts as $p): ?>

<?php
    $imgName = trim($p['image'] ?? '');

    // --- CẤU HÌNH ĐÚNG THEO ẢNH BẠN GỬI ---
    // Đường dẫn gốc chứa ảnh sản phẩm: public/uploads/products/
    $baseProductFolder = BASE_URL . '/uploads/products/'; 
    
    // Đường dẫn ảnh mặc định nếu lỗi
    $noImage = BASE_URL . '/assets/images/no-image.png';

    if (empty($imgName)) {
        // 1. Không có tên ảnh
        $displayImg = $noImage;
    } elseif (filter_var($imgName, FILTER_VALIDATE_URL)) {
        // 2. Nếu là link online
        $displayImg = $imgName;
    } elseif (strpos($imgName, 'uploads/') === 0) {
        // 3. Nếu DB lỡ lưu cả đường dẫn 'uploads/products/abc.jpg'
        $displayImg = BASE_URL . '/' . $imgName;
    } else {
        // 4. Trường hợp phổ biến nhất: Chỉ lưu tên file (s24-ultra.jpg)
        // -> Nối vào thư mục uploads/products/
        $displayImg = $baseProductFolder . $imgName;
    }
?>

    <div class="col-6 col-md-3">
        <div class="card product-card h-100">

            <div class="bg-light rounded-top d-flex align-items-center justify-content-center p-3"
                 style="height:200px; position:relative;">

                <?php if (!empty($p['discount']) && $p['discount'] > 0): ?>
                    <span class="badge bg-danger shadow-sm"
                          style="position:absolute; top:10px; left:10px; font-size:12px;">
                        -<?= $p['discount'] ?>%
                    </span>
                <?php endif; ?>

                <img src="<?= $displayImg ?>"
                     alt="<?= htmlspecialchars($p['productname']) ?>"
                     class="product-image"
                     loading="lazy" 
                     onerror="this.onerror=null; this.src='<?= BASE_URL ?>/assets/images/no-image.png';">
            </div>

            <div class="card-body d-flex flex-column p-3">
                <div style="height:42px; overflow:hidden;">
                    <h6 class="fw-bold text-dark mb-1" style="font-size:14px; line-height:1.4;">
                        <?= htmlspecialchars($p['productname']) ?>
                    </h6>
                </div>

                <div class="mt-auto pt-3">
                    <?php if (!empty($p['discount']) && $p['discount'] > 0): ?>
                        <div class="d-flex flex-column">
                            <small class="text-muted text-decoration-line-through">
                                <?= number_format($p['price'], 0, ',', '.') ?> ₫
                            </small>
                            <span class="fw-bold text-danger fs-6">
                                <?= number_format($p['price'] - ($p['price'] * $p['discount'] / 100), 0, ',', '.') ?> ₫
                            </span>
                        </div>
                    <?php else: ?>
                        <span class="fw-bold text-danger fs-6">
                            <?= number_format($p['price'], 0, ',', '.') ?> ₫
                        </span>
                    <?php endif; ?>

                    <a href="<?= BASE_URL ?>/product/detail/<?= $p['id'] ?>"
                       class="btn btn-outline-primary btn-sm w-100 mt-2 fw-bold" 
                       style="border-radius: 6px;">
                        Xem chi tiết
                    </a>
                </div>

            </div>
        </div>
    </div>

<?php endforeach; ?>

</div>