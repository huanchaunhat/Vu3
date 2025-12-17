<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin - Acen Center</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="<?= BASE_URL ?>/admin/dashboard">Acen Admin</a>
        <a class="btn btn-outline-light" href="<?= BASE_URL ?>">Về trang bán hàng</a>
    </div>
</nav>

<div class="container mt-4">
    <div class="row">
        <aside class="col-3">
            <div class="list-group">
                <a href="<?= BASE_URL ?>/admin/dashboard" class="list-group-item list-group-item-action">Dashboard</a>
                <a href="<?= BASE_URL ?>/admin/category/index" class="list-group-item list-group-item-action">Danh mục</a>
                <a href="<?= BASE_URL ?>/admin/product/index" class="list-group-item list-group-item-action">Sản phẩm</a>
                <a href="<?= BASE_URL ?>/admin/order/index" class="list-group-item list-group-item-action">Đơn hàng</a>
            </div>
        </aside>
        <main class="col-9">
