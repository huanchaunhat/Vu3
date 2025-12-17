<!-- BREADCRUMB -->
<div class="mb-3" style="font-size:14px; color:#777;">
    Trang chủ <span style="color:#999;">›</span> Mới nhất
</div>

<!-- HERO SECTION -->
<div class="row mb-4">
    <div class="col-12">
        <div class="hero-box bg-white rounded-4 p-5 shadow-sm d-flex justify-content-between align-items-center">

            <!-- LEFT CONTENT -->
            <div style="flex:1;">
                <h1 class="fw-bold mb-3" style="color:#222;">
                    Chào mừng đến <span class="text-primary">Acen Center</span>
                </h1>

                <p class="fs-6 mb-4 text-muted">
                    Chuyên điện thoại Android chính hãng: Samsung, Xiaomi, Oppo, Vivo, Tecno,...
                    <br>Giá tốt – giao nhanh – bảo hành đầy đủ!
                </p>

                <a class="btn btn-primary btn-lg px-4" href="<?= BASE_URL ?>/product">
                    Xem tất cả sản phẩm →
                </a>

                <div class="mt-4" style="font-size:15px;">
                    <div class="row text-muted">
                        <div class="col-md-6">🚚 Giao hàng nhanh</div>
                        <div class="col-md-6">🛡 Bảo hành chính hãng</div>
                        <div class="col-md-6">🔄 Đổi trả 7 ngày</div>
                        <div class="col-md-6">💳 Trả góp 0%</div>
                    </div>
                </div>
            </div>

            <!-- HERO IMAGE -->
            <div style="flex:1; text-align:right;">
                <img src="<?= BASE_URL ?>/assets/images/s25.png"
                     alt="Samsung"
                     style="height:240px; object-fit:contain;"
                     onerror="this.style.display='none'">
            </div>

        </div>
    </div>
</div>

<!-- SECTION HEADER -->
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="fw-bold mb-0" style="color:#333;">🔥 Sản phẩm nổi bật</h3>
    <a href="<?= BASE_URL ?>/product"
       class="fw-bold text-primary"
       style="text-decoration:none;">
        Xem thêm →
    </a>
</div>

<!-- PRODUCT LIST -->
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

    <div class="col-md-3">
        <div class="card product-card h-100">

            <div class="bg-light rounded-top d-flex align-items-center justify-content-center p-3"
                 style="height:200px; position:relative;">

                <!-- BADGE GIẢM GIÁ -->
                <?php if (!empty($p['discount']) && $p['discount'] > 0): ?>
                    <span class="badge bg-danger"
                          style="position:absolute; top:10px; left:10px; font-size:13px;">
                        -<?= $p['discount'] ?>%
                    </span>
                <?php endif; ?>

                <img src="<?= $displayImg ?>"
                     alt="<?= htmlspecialchars($p['productname']) ?>"
                     class="product-image"
                     onerror="this.src='<?= BASE_URL ?>/assets/images/no-image.png'">
            </div>

            <div class="card-body d-flex flex-column">

                <div style="height:42px; overflow:hidden;">
                    <p class="fw-bold text-dark mb-1" style="font-size:15px;">
                        <?= htmlspecialchars($p['productname']) ?>
                    </p>
                </div>

                <!-- GIÁ -->
                <?php if (!empty($p['discount']) && $p['discount'] > 0): ?>
                    <div class="mb-3">
                        <span class="text-muted text-decoration-line-through" style="font-size:14px;">
                            <?= number_format($p['price']) ?> ₫
                        </span><br>
                        <span class="fw-bold text-danger" style="font-size:16px;">
                            <?= number_format(
                                $p['price'] - ($p['price'] * $p['discount'] / 100)
                            ) ?> ₫
                        </span>
                    </div>
                <?php else: ?>
                    <p class="fw-bold text-danger mb-3" style="font-size:16px;">
                        <?= number_format($p['price']) ?> ₫
                    </p>
                <?php endif; ?>

                <a href="<?= BASE_URL ?>/product/detail/<?= $p['id'] ?>"
                   class="btn product-btn border-primary text-primary fw-bold btn-sm w-100 mt-auto">
                    Xem chi tiết
                </a>

            </div>
        </div>
    </div>

<?php endforeach; ?>

</div>

<!-- STYLE -->
<style>
/* HERO VIỀN HIỆN ĐẠI */
.hero-box {
    position: relative;
    border: 1px solid transparent;
    background:
        linear-gradient(#fff, #fff) padding-box,
        linear-gradient(135deg,
            #e5e7eb,
            #dbeafe,
            #e0e7ff,
            #e5e7eb
        ) border-box;
    transition: all .25s ease;
}

.hero-box:hover {
    box-shadow: 0 12px 35px rgba(37,99,235,0.08);
}

/* PRODUCT CARD */
.product-card {
    border: 1px solid #eef2f7;
    border-radius: 12px;
    background: #fff;
    transition: .25s ease;
}

.product-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
}

.product-image {
    max-width: 90%;
    max-height: 100%;
    object-fit: contain;
    transition: .3s ease;
}

.product-image:hover {
    transform: scale(1.08);
}

.product-btn {
    border-radius: 8px;
    transition: .2s ease-in-out;
}

.product-btn:hover {
    background: #0d6efd;
    color: white !important;
}
</style>
