<h3>Đăng ký</h3>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $e): ?>
            <div><?= $e ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="post">
    <div class="mb-3">
        <label class="form-label">Họ tên</label>
        <input type="text" name="fullname" class="form-control"
               value="<?= htmlspecialchars($old['fullname'] ?? '') ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control"
               value="<?= htmlspecialchars($old['email'] ?? '') ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Mật khẩu</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Xác nhận mật khẩu</label>
        <input type="password" name="confirm_password" class="form-control" required>
    </div>
    <button class="btn btn-success">Đăng ký</button>
</form>
