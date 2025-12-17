<?php $isEdit = !empty($product); ?>

<h3 class="mb-3"><?= $isEdit ? 'Sửa sản phẩm' : 'Thêm sản phẩm' ?></h3>

<form method="post" enctype="multipart/form-data" class="p-3 rounded shadow-sm" style="max-width:850px; background:#fff;">
    
    <!-- DANH MỤC -->
    <div class="mb-3">
        <label class="form-label fw-bold">Danh mục</label>
        <select name="categoryid" class="form-select" required>
            <?php foreach ($categories as $c): ?>
                <option value="<?= $c['id'] ?>"
                    <?= ($isEdit && $product['categoryid'] == $c['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($c['categoryname']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- TÊN SP -->
    <div class="mb-3">
        <label class="form-label fw-bold">Tên sản phẩm</label>
        <input type="text" name="productname" class="form-control" 
               value="<?= htmlspecialchars($product['productname'] ?? '') ?>" required>
    </div>

    <!-- GIÁ -->
    <div class="mb-3">
        <label class="form-label fw-bold">Giá bán (₫)</label>
        <input type="number" name="price" class="form-control"
               value="<?= htmlspecialchars($product['price'] ?? '') ?>" required>
    </div>

    <!-- SỐ LƯỢNG -->
    <div class="mb-3">
        <label class="form-label fw-bold">Số lượng tồn</label>
        <input type="number" name="quantity" class="form-control"
               value="<?= htmlspecialchars($product['quantity'] ?? 0) ?>" required>
    </div>

    <!-- GIẢM GIÁ -->
    <div class="mb-3">
        <label class="form-label fw-bold">Giảm giá (%)</label>
        <input type="number" step="0.1" name="discount" class="form-control"
               value="<?= htmlspecialchars($product['discount'] ?? 0) ?>">
    </div>

    <!-- UPLOAD ẢNH -->
    <div class="mb-3">
        <label class="form-label fw-bold">Ảnh sản phẩm</label>
        <input type="file" name="image" class="form-control" <?= !$isEdit ? 'required' : '' ?>>

        <?php if ($isEdit && !empty($product['image'])): ?>
            <div class="mt-2">
                <p class="small">Ảnh hiện tại:</p>
                <img src="<?= BASE_URL ?>/uploads/products/<?= $product['image'] ?>"
                     style="width:120px; border-radius:8px; border:1px solid #ccc;">
            </div>
        <?php endif; ?>
    </div>

    <!-- MÔ TẢ -->
    <div class="mb-3">
        <label class="form-label fw-bold">Mô tả sản phẩm</label>
        <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($product['description'] ?? '') ?></textarea>
    </div>

    <!-- THÔNG SỐ KỸ THUẬT -->
    <div class="mb-3">
        <label class="form-label fw-bold">Thông số kỹ thuật</label>
        <textarea name="detail" class="form-control" rows="3"><?= htmlspecialchars($product['detail'] ?? '') ?></textarea>
    </div>

    <!-- TRẠNG THÁI -->
    <div class="mb-3 form-check">
        <input type="checkbox" name="status" class="form-check-input"
            <?= $isEdit ? ($product['status'] ? 'checked' : '') : 'checked' ?>>
        <label class="form-check-label fw-bold">Đang bán</label>
    </div>

    <!-- ACTION BUTTON -->
    <button class="btn btn-success px-4"><?= $isEdit ? 'Lưu lại' : 'Thêm mới' ?></button>
    <a class="btn btn-secondary px-4" href="<?= BASE_URL ?>/admin/product">Quay lại</a>

</form>


<style>
form input, form textarea, form select {
    border-radius: 8px;
    padding: 10px;
    border: 1px solid #bbb;
}
form strong, .fw-bold {
    font-weight: 600;
}
</style>
