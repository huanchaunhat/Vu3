<?php
$user = $_SESSION['user'] ?? null;
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Acen Center - Bán điện thoại Android</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="<?= BASE_URL ?>">Acen Center</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <form class="d-flex ms-auto" method="get" action="<?= BASE_URL ?>/product">
                <input class="form-control me-2" type="search" name="keyword" placeholder="Tìm điện thoại...">
                <button class="btn btn-outline-light" type="submit">Tìm</button>
            </form>
            <ul class="navbar-nav ms-3">
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>/cart">Giỏ hàng</a>
                </li>
                <?php if ($user): ?>
                    <li class="nav-item">
                        <span class="nav-link">Xin chào, <?= htmlspecialchars($user['name']) ?></span>
                    </li>
                    <?php if ($user['role'] === 'admin'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL ?>/admin/dashboard">Admin</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>/auth/logout">Đăng xuất</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>/auth/login">Đăng nhập</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>/auth/register">Đăng ký</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
