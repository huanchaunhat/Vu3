<h3 class="mb-3 fw-bold" style="font-size:28px;">Danh sách điện thoại</h3>

<form class="row mb-4" method="get" action="<?= BASE_URL ?>/product">
    <div class="col-md-3">
        <input type="text" name="keyword" class="form-control search-input"
               value="<?= htmlspecialchars($filters['keyword'] ?? '') ?>"
               placeholder="Tìm theo tên...">
    </div>

    <div class="col-md-3">
        <select name="categoryid" class="form-select">
            <option value="">-- Tất cả hãng --</option>

            <?php foreach ($categories as $c): ?>
                <option value="<?= $c['id'] ?>"
                    <?= ($filters['categoryid'] ?? '') == $c['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($c['categoryname']) ?>
                </option>
            <?php endforeach; ?>

        </select>
    </div>

    <div class="col-md-2">
        <input type="number" name="min_price" class="form-control"
               placeholder="Giá từ" 
               value="<?= htmlspecialchars($filters['min_price'] ?? '') ?>">
    </div>

    <div class="col-md-2">
        <input type="number" name="max_price" class="form-control"
               placeholder="Giá đến" 
               value="<?= htmlspecialchars($filters['max_price'] ?? '') ?>">
    </div>

    <div class="col-md-2 d-grid">
        <button class="btn btn-primary filter-btn" type="submit">Lọc</button>
    </div>
</form>



<div class="row g-4">

<?php foreach ($products as $p): ?>

    <?php
        $img = !empty($p['image']) ? $p['image'] : 'no-img.png';
        $imgPath = BASE_URL . "/uploads/products/" . $img;
    ?>

    <div class="col-md-3">
        <div class="card product-card h-100">

            <!-- Ảnh -->
            <div class="product-image-box bg-light">
                <img src="<?= $imgPath ?>"
                     alt="<?= htmlspecialchars($p['productname']) ?>"
                     class="product-image">
            </div>

            <!-- Nội dung -->
            <div class="card-body">

                <div class="product-title">
                    <?= htmlspecialchars($p['productname']) ?>
                </div>

                <p class="text-muted mb-1" style="font-size:14px;">
                    <?= htmlspecialchars($p['categoryname']) ?>
                </p>

                <p class="text-danger fw-bold price-text">
                    <?= number_format($p['price']) ?> ₫
                </p>

                <a href="<?= BASE_URL ?>/product/detail/<?= $p['id'] ?>"
                   class="btn product-btn w-100">
                    Xem chi tiết
                </a>
            </div>
        </div>
    </div>

<?php endforeach; ?>

</div>



<style>
/* ==============================
   SEARCH INPUT
==============================*/
.search-input {
    border-radius: 10px;
    transition: .25s;
}
.search-input:focus {
    box-shadow: 0 0 0 0.2rem rgba(13,110,253,0.25);
}


/* ==============================
   PRODUCT CARD
==============================*/
.product-card {
    border-radius: 14px;
    overflow: hidden;
    transition: .28s ease;
    border: 0;
}
.product-card:hover {
    transform: translateY(-6px);
    box-shadow: 0px 12px 28px rgba(0,0,0,0.15);
}


/* ==============================
   PRODUCT IMAGE
==============================*/
.product-image-box {
    height: 220px;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
}

.product-image {
    max-width: 90%;
    max-height: 90%;
    transition: .35s ease-in-out;
}

.product-card:hover .product-image {
    transform: scale(1.08);
}


/* ==============================
   PRODUCT TITLE
==============================*/
.product-title {
    font-weight: 600;
    font-size: 15px;
    height: 42px;
    overflow: hidden;
    line-height: 20px;
}


/* ==============================
   PRICE TEXT
==============================*/
.price-text {
    font-size: 17px;
}


/* ==============================
   BUTTON
==============================*/
.product-btn {
    border: 1px solid #0d6efd;
    color: #0d6efd;
    font-weight: 600;
    border-radius: 12px;
    transition: .25s ease;
    padding: 6px 0;
}

.product-btn:hover {
    background: #0d6efd;
    color: #fff !important;
    box-shadow: 0 6px 15px rgba(13,110,253,0.35);
}
</style>
