<h3>Giỏ hàng</h3>

<form method="post" action="<?= BASE_URL ?>/cart/update">
<table class="table table-bordered align-middle">
    <thead>
    <tr>
        <th>Sản phẩm</th>
        <th>Giá</th>
        <th>Số lượng</th>
        <th>Thành tiền</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($items as $item): ?>
        <tr>
            <td><?= htmlspecialchars($item['productname']) ?></td>
            <td><?= number_format($item['price']) ?> ₫</td>
            <td style="width:120px;">
                <input type="number" class="form-control" min="1"
                       name="quantities[<?= $item['productid'] ?>]"
                       value="<?= $item['quantity'] ?>">
            </td>
            <td><?= number_format($item['price'] * $item['quantity']) ?> ₫</td>
            <td>
                <a class="btn btn-sm btn-outline-danger"
                   href="<?= BASE_URL ?>/cart/remove/<?= $item['productid'] ?>">X</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<div class="d-flex justify-content-between">
    <div>
        <a href="<?= BASE_URL ?>/product" class="btn btn-outline-secondary">Tiếp tục mua</a>
    </div>
    <div>
        <strong>Tổng tiền: <?= number_format($total) ?> ₫</strong>
    </div>
</div>

<div class="mt-3 text-end">
    <button class="btn btn-primary" type="submit">Cập nhật giỏ hàng</button>
    <a class="btn btn-success" href="<?= BASE_URL ?>/cart/checkout">Thanh toán</a>
</div>
</form>
