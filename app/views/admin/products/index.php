<div class="d-flex justify-content-between mb-3">
    <h3>Sản phẩm</h3>
    <a class="btn btn-primary" href="<?= BASE_URL ?>/admin/product/create">Thêm sản phẩm</a>
</div>

<table class="table table-bordered align-middle">
    <thead>
    <tr>
        <th>ID</th>
        <th>Tên</th>
        <th>Giá</th>
        <th>Tồn kho</th>
        <th>Trạng thái</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($products as $p): ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><?= htmlspecialchars($p['productname']) ?></td>
            <td><?= number_format($p['price']) ?> ₫</td>
            <td><?= $p['quantity'] ?></td>
            <td><?= $p['status'] ? 'Bán' : 'Ẩn' ?></td>
            <td>
                <a class="btn btn-sm btn-warning"
                   href="<?= BASE_URL ?>/admin/product/edit/<?= $p['id'] ?>">Sửa</a>
                <a class="btn btn-sm btn-danger"
                   href="<?= BASE_URL ?>/admin/product/delete/<?= $p['id'] ?>"
                   onclick="return confirm('Xóa sản phẩm?')">Xóa</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
