<?php
// app/config/config.php

function getEnvValue($key, $default) {
    $value = getenv($key);
    return $value !== false ? $value : $default;
}

// Cấu hình Database
define('DB_HOST', getEnvValue('DB_HOST', 'localhost'));
define('DB_NAME', getEnvValue('DB_NAME', 'acen_center'));
define('DB_USER', getEnvValue('DB_USER', 'root'));
define('DB_PASS', getEnvValue('DB_PASS', ''));
// Thêm cấu hình Port (Mặc định local là 3306, nhưng Aiven sẽ khác)
define('DB_PORT', getEnvValue('DB_PORT', '3306'));

// Base URL
define('BASE_URL', getEnvValue('BASE_URL', 'http://localhost/acen-center/public'));

function getPDO()
{
    static $pdo = null;

    if ($pdo === null) {
        // Cập nhật DSN để nhận thêm PORT
        $dsn = 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=utf8mb4';

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        // Nếu đang chạy trên Aiven (Port khác 3306), bật chế độ SSL
        if (DB_PORT != '3306') {
            $options[PDO::MYSQL_ATTR_SSL_CA] = '/etc/ssl/certs/ca-certificates.crt'; // Đường dẫn CA mặc định trên Linux/Vercel
            $options[PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT] = false; // Tắt check nghiêm ngặt để tránh lỗi chứng chỉ trên Vercel
        }

        try {
            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            // Chỉ hiện lỗi chung để bảo mật
            die('Lỗi kết nối Database (Check Config/SSL): ' . $e->getMessage());
        }
    }

    return $pdo;
}