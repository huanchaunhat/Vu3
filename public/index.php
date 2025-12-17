<?php
// public/index.php

session_start(); // dùng session lưu thông tin đăng nhập

require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/core/App.php';
require_once __DIR__ . '/../app/core/Controller.php';
require_once __DIR__ . '/../app/core/Model.php';

// Chạy ứng dụng
$app = new App();
