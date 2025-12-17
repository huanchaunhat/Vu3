<div style="
    display:flex; 
    justify-content:space-between; 
    align-items:center; 
    margin-bottom:25px;
">
    <h3 style="font-weight:700; color:#0d6efd; margin:0;">
        <i class="fa-solid fa-layer-group" style="margin-right:8px;"></i> Danh mục
    </h3>

    <a href="<?= BASE_URL ?>/admin/category/create"
       style="
            background:#0d6efd;
            color:#fff;
            padding:10px 22px;
            border-radius:10px;
            font-weight:600;
            text-decoration:none;
            border:1px solid transparent;
            transition:.25s;
            display:flex;
            align-items:center;
        "
        onmouseover="this.style.background='#0b5ed7'"
        onmouseout="this.style.background='#0d6efd'"
    >
        <i class="fa-solid fa-plus" style="margin-right:8px;"></i> Thêm danh mục
    </a>
</div>


<div style="
    background:#fff;
    border-radius:16px;
    padding:18px;
    box-shadow:0 4px 16px rgba(0,0,0,0.08);
    border:1px solid #f1f1f1;
">

    <table style="width:100%; border-collapse: separate; border-spacing:0; font-size:15px;">
        <thead>
            <tr style="
                background:#eef4ff;
                font-weight:600;
                color:#1b3d6e;
            ">
                <th style="padding:14px 10px; border-bottom:2px solid #dee2e6;">ID</th>
                <th style="padding:14px 10px; border-bottom:2px solid #dee2e6;">Tên danh mục</th>
                <th style="padding:14px 10px; border-bottom:2px solid #dee2e6;">Trạng thái</th>
                <th style="padding:14px 10px; border-bottom:2px solid #dee2e6; width:180px; text-align:center;">Chức năng</th>
            </tr>
        </thead>

        <tbody>
        <?php foreach ($categories as $c): ?>

            <tr style="
                border-bottom:1px solid #f1f1f1;
                transition:0.25s;
            "
            onmouseover="this.style.background='#f8fbff'"
            onmouseout="this.style.background='#fff'"
            >
                <td style="padding:14px 10px;"><?= $c['id'] ?></td>

                <td style="padding:14px 10px;">
                    <span style="font-weight:600;"><?= htmlspecialchars($c['categoryname']) ?></span>
                </td>

                <td style="padding:14px 10px;">
                    <?php if ($c['status']): ?>
                        <span style="
                            display:inline-block;
                            padding:6px 14px;
                            background:#e7f5e8;
                            color:#117a3a;
                            border-radius:8px;
                            font-weight:600;
                            font-size:14px;
                        ">Hiển thị</span>
                    <?php else: ?>
                        <span style="
                            display:inline-block;
                            padding:6px 14px;
                            background:#fee7e7;
                            color:#b10000;
                            border-radius:8px;
                            font-weight:600;
                            font-size:14px;
                        ">Ẩn</span>
                    <?php endif; ?>
                </td>

                <td style="padding:14px 10px; text-align:center;">
                    <a href="<?= BASE_URL ?>/admin/category/edit/<?= $c['id'] ?>"
                       style="
                            background:#ffc107;
                            color:#000;
                            padding:7px 14px;
                            border-radius:10px;
                            font-weight:600;
                            text-decoration:none;
                            display:inline-flex;
                            align-items:center;
                            gap:6px;
                            margin-right:8px;
                            transition:.25s;
                        "
                        onmouseover="this.style.opacity='0.85'"
                        onmouseout="this.style.opacity='1'"
                    >
                        <i class="fa-solid fa-pen-to-square"></i>
                        Sửa
                    </a>

                    <a href="<?= BASE_URL ?>/admin/category/delete/<?= $c['id'] ?>"
                       onclick="return confirm('Bạn có chắc muốn xóa?')"
                       style="
                            background:#dc3545;
                            color:#fff;
                            padding:7px 14px;
                            border-radius:10px;
                            font-weight:600;
                            text-decoration:none;
                            display:inline-flex;
                            align-items:center;
                            gap:6px;
                            transition:.25s;
                        "
                        onmouseover="this.style.opacity='0.85'"
                        onmouseout="this.style.opacity='1'"
                    >
                        <i class="fa-solid fa-trash"></i>
                        Xóa
                    </a>
                </td>
            </tr>

        <?php endforeach; ?>
        </tbody>

    </table>
</div>
