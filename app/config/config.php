<?php
// app/config/config.php

// Thông tin DB
define('DB_HOST', 'localhost');
define('DB_NAME', 'acen_center');
define('DB_USER', 'root');
define('DB_PASS', ''); // WAMP mặc định rỗng

// Base URL (sửa lại cho đúng thư mục của bạn)
// Ví dụ: http://localhost/acen-center/public
define('BASE_URL', 'http://localhost/acen-center/public');

// Hàm trả về đối tượng PDO dùng chung
function getPDO()
{
    static $pdo = null;

    if ($pdo === null) {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';

        try {
            $pdo = new PDO($dsn, DB_USER, DB_PASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Kết nối DB thất bại: ' . $e->getMessage());
        }
    }

    return $pdo;
}
