<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:22px;">
    <h3 style="font-weight:700; color:#0d6efd; margin:0;">
        <i class="fa-solid fa-cart-shopping" style="margin-right:8px;"></i>
        Đơn hàng
    </h3>
</div>


<div style="
    background:#fff;
    border-radius:16px;
    padding:20px;
    border:1px solid #eeeeee;
    box-shadow:0 6px 20px rgba(0,0,0,0.06);
">

    <table style="width:100%; border-collapse: separate; border-spacing:0;">
        <thead>
            <tr style="
                background:#eef4ff;
                font-weight:600;
                color:#1b3d6e;
                text-transform:uppercase;
                font-size:14px;
            ">
                <th style="padding:12px 10px; border-bottom:2px solid #dee2e6;">Mã đơn</th>
                <th style="padding:12px 10px; border-bottom:2px solid #dee2e6;">Khách hàng</th>
                <th style="padding:12px 10px; border-bottom:2px solid #dee2e6;">Tổng tiền</th>
                <th style="padding:12px 10px; border-bottom:2px solid #dee2e6;">Trạng thái</th>
                <th style="padding:12px 10px; border-bottom:2px solid #dee2e6;">Ngày tạo</th>
                <th style="padding:12px 10px; border-bottom:2px solid #dee2e6; text-align:center;">Thao tác</th>
            </tr>
        </thead>

        <tbody>
        <?php foreach ($orders as $o): ?>

            <tr style="
                transition:0.25s;
                border-bottom:1px solid #f1f1f1;
            "
            onmouseover="this.style.background='#f8fbff'"
            onmouseout="this.style.background='#fff'"
            >
                <!-- ID -->
                <td style="padding:12px 10px;">
                    <strong>#<?= $o['id'] ?></strong>
                </td>

                <!-- CUSTOMER NAME -->
                <td style="padding:12px 10px;">
                    <?= htmlspecialchars($o['fullname']) ?>
                </td>

                <!-- TOTAL -->
                <td style="padding:12px 10px; font-weight:600; color:#198754;">
                    <?= number_format($o['total']) ?>₫
                </td>

                <!-- STATUS -->
                <td style="padding:12px 10px;">
                    <?php if ($o['status'] == 'completed'): ?>
                        <span style="
                            padding:6px 12px;
                            background:#d1f4e3;
                            color:#0a8e45;
                            border-radius:8px;
                            font-weight:600;
                            font-size:13px;
                        ">Hoàn thành</span>

                    <?php elseif ($o['status'] == 'shipping'): ?>
                        <span style="
                            padding:6px 12px;
                            background:#ffefd1;
                            color:#b78500;
                            border-radius:8px;
                            font-weight:600;
                            font-size:13px;
                        ">Đang giao</span>

                    <?php elseif ($o['status'] == 'processing'): ?>
                        <span style="
                            padding:6px 12px;
                            background:#e1ecff;
                            color:#0d6efd;
                            border-radius:8px;
                            font-weight:600;
                            font-size:13px;
                        ">Đang xử lý</span>

                    <?php else: ?>
                        <span style="
                            padding:6px 12px;
                            background:#ffdede;
                            color:#b30000;
                            border-radius:8px;
                            font-weight:600;
                            font-size:13px;
                        "><?= htmlspecialchars($o['status']) ?></span>
                    <?php endif; ?>
                </td>

                <!-- CREATED DATE -->
                <td style="padding:12px 10px; color:#666;">
                    <?= $o['createdate'] ?>
                </td>

                <!-- ACTION -->
                <td style="padding:12px 10px; text-align:center;">
                    <a href="<?= BASE_URL ?>/admin/order/detail/<?= $o['id'] ?>"
                       style="
                            background:#0d6efd;
                            color:#fff;
                            padding:8px 14px;
                            border-radius:10px;
                            text-decoration:none;
                            font-weight:600;
                            display:inline-flex;
                            align-items:center;
                            gap:6px;
                            transition:.25s;
                        "
                        onmouseover="this.style.background='#0b5ed7'"
                        onmouseout="this.style.background='#0d6efd'"
                    >
                        <i class="fa-solid fa-eye"></i> Chi tiết
                    </a>
                </td>
            </tr>

        <?php endforeach; ?>
        </tbody>

    </table>

</div>
