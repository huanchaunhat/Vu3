<div style="padding: 5px;">
    <h3 style="
        font-weight:700; 
        color:#0d6efd;
        margin-bottom: 8px;">
        <i class="fa-solid fa-chart-line" style="margin-right:8px;"></i>
        Dashboard
    </h3>

    <p style="color:#555; margin-top:0;">
        Chào mừng Admin đến hệ thống quản trị <strong>Acen Center</strong>.
    </p>

    <!-- STAT CARDS -->
    <div style="display:flex; gap:18px; margin-top:25px; flex-wrap:wrap;">

        <div style="
            flex:1; 
            min-width:220px; 
            background:#fff; 
            border-radius:14px; 
            padding:18px; 
            box-shadow:0 8px 22px rgba(0,0,0,0.06);
            border:1px solid #eef2f7;
        ">
            <div style="font-size:32px; font-weight:700; color:#0d6efd;">12</div>
            <div style="color:#555;">Danh mục</div>
        </div>

        <div style="
            flex:1; 
            min-width:220px; 
            background:#fff; 
            border-radius:14px; 
            padding:18px; 
            box-shadow:0 8px 22px rgba(0,0,0,0.06);
            border:1px solid #eef2f7;
        ">
            <div style="font-size:32px; font-weight:700; color:#6f42c1;">58</div>
            <div style="color:#555;">Sản phẩm</div>
        </div>

        <div style="
            flex:1; 
            min-width:220px; 
            background:#fff; 
            border-radius:14px; 
            padding:18px; 
            box-shadow:0 8px 22px rgba(0,0,0,0.06);
            border:1px solid #eef2f7;
        ">
            <div style="font-size:32px; font-weight:700; color:#198754;">12</div>
            <div style="color:#555;">Đơn hàng đang xử lý</div>
        </div>

        <div style="
            flex:1; 
            min-width:220px; 
            background:#fff; 
            border-radius:14px; 
            padding:18px; 
            box-shadow:0 8px 22px rgba(0,0,0,0.06);
            border:1px solid #eef2f7;
        ">
            <div style="font-size:32px; font-weight:700; color:#dc3545;">216</div>
            <div style="color:#555;">Khách hàng đã đăng ký</div>
        </div>

    </div>

    <!-- Quick navigation -->
    <div style="
        background:#fff; 
        border-radius:16px; 
        padding:20px; 
        margin-top:30px; 
        box-shadow:0px 6px 20px rgba(0,0,0,0.07);
        border:1px solid #f3f3f3;
    ">
        <h4 style="margin-bottom:18px; color:#0d6efd;">
            <i class="fa-solid fa-gears" style="margin-right:8px;"></i>
            Chức năng nhanh
        </h4>

        <div style="display:flex; gap:14px; flex-direction:column; font-size:16px;">

            <a href="<?= BASE_URL ?>/admin/category/index"
                style="
                    background:#eef4ff;
                    padding:10px 14px;
                    border-radius:10px;
                    text-decoration:none;
                    font-weight:600;
                    color:#0d6efd;
                    display:flex;
                    align-items:center;
                    gap:10px;
                    transition:.25s;
                "
                onmouseover="this.style.background='#dbe7ff'"
                onmouseout="this.style.background='#eef4ff'"
            >
                <i class="fa-solid fa-tags"></i>
                Quản lý danh mục
            </a>

            <a href="<?= BASE_URL ?>/admin/product/index"
                style="
                    background:#eaf7ed;
                    padding:10px 14px;
                    border-radius:10px;
                    text-decoration:none;
                    font-weight:600;
                    color:#198754;
                    display:flex;
                    align-items:center;
                    gap:10px;
                    transition:.25s;
                "
                onmouseover="this.style.background='#d4f2dc'"
                onmouseout="this.style.background='#eaf7ed'"
            >
                <i class="fa-solid fa-box"></i>
                Quản lý sản phẩm
            </a>

            <a href="<?= BASE_URL ?>/admin/order/index"
                style="
                    background:#fff1f1;
                    padding:10px 14px;
                    border-radius:10px;
                    text-decoration:none;
                    font-weight:600;
                    color:#dc3545;
                    display:flex;
                    align-items:center;
                    gap:10px;
                    transition:.25s;
                "
                onmouseover="this.style.background='#ffdcdc'"
                onmouseout="this.style.background='#fff1f1'"
            >
                <i class="fa-solid fa-cart-shopping"></i>
                Quản lý đơn hàng
            </a>

        </div>
    </div>
</div>
