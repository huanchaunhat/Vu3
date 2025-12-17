<?php $isEdit = !empty($category); ?>

<div style="background: #fff; border-radius: 20px; box-shadow: 0 6px 22px rgba(0,0,0,0.09); padding: 30px; border: 1px solid #f1f1f1;">
    
    <div style="display:flex; align-items:center; margin-bottom: 25px;">
        <i class="fa-solid fa-layer-group" style="
            font-size: 26px;
            padding: 12px;
            border-radius: 14px;
            background: linear-gradient(135deg,#0d6efd,#6f42c1);
            color: #fff;
            margin-right: 10px;"></i>

        <h3 style="font-weight:700; margin:0; color:#0d6efd;">
            <?= $isEdit ? 'Sửa danh mục' : 'Thêm danh mục mới' ?>
        </h3>
    </div>

    <form method="post">

        <!-- NAME -->
        <div style="margin-bottom: 22px;">
            <label style="font-weight:600; margin-bottom: 6px; display:block;">Tên danh mục <span style="color:red;">*</span></span></label>
            <input type="text" name="categoryname"
                value="<?= htmlspecialchars($category['categoryname'] ?? '') ?>" required
                style="
                    width:100%;
                    border-radius: 12px;
                    padding: 12px;
                    border: 1px solid #d8d8d8;
                    transition: 0.25s;
                    background:#fff;
                "
                onfocus="this.style.border='1px solid #0d6efd'; this.style.boxShadow='0 0 4px rgba(13,110,253,0.4)';"
                onblur="this.style.border='1px solid #d8d8d8'; this.style.boxShadow='none';"
                placeholder='Ví dụ: Samsung, Oppo, Xiaomi ...'>
        </div>

        <!-- DESCRIPTION -->
        <div style="margin-bottom: 22px;">
            <label style="font-weight:600; margin-bottom: 6px; display:block;">Mô tả danh mục</label>

            <textarea name="description" rows="3"
                style="
                    width:100%;
                    border-radius: 12px;
                    padding: 12px;
                    border: 1px solid #d8d8d8;
                    transition: 0.25s;
                    background:#fff;
                    resize: vertical;
                "
                onfocus="this.style.border='1px solid #0d6efd'; this.style.boxShadow='0 0 4px rgba(13,110,253,0.4)';"
                onblur="this.style.border='1px solid #d8d8d8'; this.style.boxShadow='none';"
            ><?= htmlspecialchars($category['description'] ?? '') ?></textarea>
        </div>

        <!-- STATUS -->
        <div style="margin-bottom: 25px; display:flex; align-items:center;">
            <input type="checkbox" name="status"
                <?= isset($category['status']) ? ($category['status'] ? 'checked' : '') : 'checked' ?>
                style="
                    width:22px;
                    height:22px;
                    cursor:pointer;
                    accent-color:#0d6efd;
                "
            >
            <label style="margin-left:10px; font-weight:600; cursor:pointer;">Hiển thị danh mục</label>
        </div>

        <!-- ACTION BUTTONS -->
        <div style="display:flex; gap: 12px;">

            <button style="
                background: linear-gradient(135deg,#0d6efd,#6f42c1);
                color:#fff;
                padding:12px 26px;
                font-weight:600;
                border:none;
                border-radius:14px;
                box-shadow:0 4px 12px rgba(13,110,253,0.32);
                cursor:pointer;
                transition:.25s;
                display:flex;
                align-items:center;
                font-size:16px;
            "
            onmouseover="this.style.transform='translateY(-2px)'"
            onmouseout="this.style.transform='translateY(0)'"
            >
                <i class="fa-solid fa-floppy-disk" style="margin-right:8px;"></i> Lưu dữ liệu
            </button>

            <a href="<?= BASE_URL ?>/admin/category/index"
               style="
                background:#f1f1f1;
                color:#333;
                padding:12px 26px;
                font-weight:600;
                border-radius:14px;
                cursor:pointer;
                display:flex;
                align-items:center;
                transition:.25s;
                font-size:16px;
                text-decoration:none;
            "
            onmouseover="this.style.background='#e2e2e2'"
            onmouseout="this.style.background='#f1f1f1'"
            >
                <i class="fa-solid fa-arrow-left" style="margin-right:8px;"></i> Quay lại
            </a>

        </div>
    </form>

</div>
