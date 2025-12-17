<h3>Thanh toán</h3>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<h5>Tóm tắt đơn hàng</h5>
<ul>
    <?php foreach ($items as $item): ?>
        <li>
            <?= htmlspecialchars($item['productname']) ?> x <?= $item['quantity'] ?>
            = <?= number_format($item['price'] * $item['quantity']) ?> ₫
        </li>
    <?php endforeach; ?>
</ul>
<p><strong>Tổng tiền: <?= number_format($total) ?> ₫</strong></p>

<form method="post">
    <div class="mb-3">
        <label class="form-label">Địa chỉ giao hàng</label>
        <textarea name="address" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Ghi chú</label>
        <textarea name="note" class="form-control"></textarea>
    </div>
    <button class="btn btn-success">Đặt hàng</button>
</form>
