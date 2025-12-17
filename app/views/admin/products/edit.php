<div class="container mt-4">
    <h3 class="mb-4 text-primary">✏️ Chỉnh sửa sản phẩm</h3>

    <form method="POST" enctype="multipart/form-data" style="max-width: 850px">

        <div class="mb-3">
            <label class="form-label">Tên sản phẩm</label>
            <input type="text" name="productname"
                   class="form-control"
                   value="<?= htmlspecialchars($product['productname']) ?>"
                   required>
        </div>

        <div class="row">
            <div class="mb-3 col-md-6">
                <label class="form-label">Giá bán (₫)</label>
                <input type="number" name="price"
                       class="form-control"
                       value="<?= htmlspecialchars($product['price']) ?>"
                       required>
            </div>

            <div class="mb-3 col-md-6">
                <label class="form-label">Số lượng</label>
                <input type="number" name="quantity"
                       class="form-control"
                       value="<?= htmlspecialchars($product['quantity']) ?>"
                       required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Danh mục</label>
            <select name="categoryid" class="form-select" required>
                <option value="">-- Chọn hãng --</option>
                <?php foreach ($categories as $c): ?>
                    <option value="<?= $c['id'] ?>"
                        <?= $product['categoryid'] == $c['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($c['categoryname']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- MÔ TẢ -->
        <div class="mb-3">
            <label class="form-label">Mô tả sản phẩm</label>
            <textarea name="description" rows="4"
                      class="form-control"><?= htmlspecialchars($product['description']) ?></textarea>
        </div>

        <!-- THÔNG SỐ KỸ THUẬT -->
        <div class="mb-3">
            <label class="form-label">Thông số kỹ thuật</label>
            <textarea name="detail" rows="4"
                      class="form-control"><?= htmlspecialchars($product['detail']) ?></textarea>

            <small class="text-secondary d-block mt-1">
                
            </small>
        </div>

        <!-- TRẠNG THÁI -->
        <div class="mb-3">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-select">
                <option value="1" <?= $product['status'] == 1 ? 'selected' : '' ?>>Còn bán</option>
                <option value="0" <?= $product['status'] == 0 ? 'selected' : '' ?>>Ngưng bán</option>
            </select>
        </div>

        <!-- ẢNH -->
        <div class="mb-3">
            <label class="form-label">Ảnh sản phẩm</label><br>

            <?php if (!empty($product['image'])): ?>
                <img src="<?= BASE_URL ?>/uploads/products/<?= $product['image'] ?>"
                     width="140"
                     class="rounded shadow-sm mb-2 border">
            <?php endif; ?>

            <input type="file" name="image" class="form-control">
            <small class="text-secondary">
                👉 Vui lòng thay đổi ảnh
            </small>
        </div>

        <div class="mt-4 d-flex gap-2">
            <button type="submit" class="btn btn-primary px-4">✔ Lưu thay đổi</button>
            <a href="<?= BASE_URL ?>/admin/product" class="btn btn-secondary px-4">⬅ Quay lại</a>
        </div>

    </form>
</div>

<style>
    form input, form select, form textarea {
        border-radius: 8px !important;
        padding: 10px;
    }

    img {
        border-radius: 10px;
    }

    h3 {
        font-weight: 700;
    }
</style>
