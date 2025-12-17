<?php
// app/config/config.php

// 1. Hàm lấy biến môi trường an toàn
function getEnvValue($key, $default) {
    $value = getenv($key);
    return $value !== false ? $value : $default;
}

// 2. Logic tự động xác định BASE_URL (Quan trọng)
// Nếu không tìm thấy biến môi trường BASE_URL, ta sẽ tự tính toán dựa trên Server
if (getenv('BASE_URL')) {
    define('BASE_URL', getenv('BASE_URL'));
} else {
    // Kiểm tra xem có phải đang chạy HTTPS không
    $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https" : "http";
    $host = $_SERVER['HTTP_HOST']; // Lấy tên miền (ví dụ: vu3-xi.vercel.app)

    // Kiểm tra xem có đang chạy ở Localhost (WAMP/XAMPP) không?
    if (strpos($host, 'localhost') !== false) {
        // CẤU HÌNH CHO LOCALHOST (Máy của bạn)
        // Bạn thay 'acen-center' bằng tên thư mục dự án thật của bạn nếu khác
        define('BASE_URL', $protocol . '://' . $host . '/acen-center/public');
    } else {
        // CẤU HÌNH CHO VERCEL / SERVER ONLINE
        // Trên Vercel, thư mục gốc chính là website luôn, không cần /public
        define('BASE_URL', $protocol . '://' . $host);
    }
}

// 3. Cấu hình Database (Giữ nguyên như cũ)
define('DB_HOST', getEnvValue('DB_HOST', 'localhost'));
define('DB_NAME', getEnvValue('DB_NAME', 'acen_center'));
define('DB_USER', getEnvValue('DB_USER', 'root'));
define('DB_PASS', getEnvValue('DB_PASS', ''));
define('DB_PORT', getEnvValue('DB_PORT', '3306'));

// 4. Hàm kết nối PDO (Giữ nguyên)
function getPDO()
{
    static $pdo = null;
    if ($pdo === null) {
        $dsn = 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=utf8mb4';
        
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        // Cấu hình SSL cho Aiven (Chỉ bật khi không phải localhost mặc định)
        if (DB_HOST !== 'localhost' && DB_PORT != '3306') {
            $options[PDO::MYSQL_ATTR_SSL_CA] = '/etc/ssl/certs/ca-certificates.crt';
            $options[PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT] = false;
        }

        try {
            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            die('Lỗi kết nối Database: ' . $e->getMessage());
        }
    }
    return $pdo;
}