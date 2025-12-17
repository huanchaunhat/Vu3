<?php
// app/controllers/AuthController.php

class AuthController extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email    = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            // Lấy user theo email
            $user = $this->userModel->findByEmail($email);

            $isValid = false;

            if ($user) {
                $hashedFromDb = $user['password'];

                // 1. Thử kiểu mới: password_hash / password_verify
                if (strlen($hashedFromDb) > 40 && password_verify($password, $hashedFromDb)) {
                    $isValid = true;
                }
                // 2. Thử legacy: MD5
                elseif (strlen($hashedFromDb) === 32 && md5($password) === $hashedFromDb) {
                    $isValid = true;
                }
                // 3. Thử plain text (trường hợp admin đang để 123)
                elseif ($password === $hashedFromDb) {
                    $isValid = true;
                }
            }

            if ($user && $isValid) {
                // Lưu session đăng nhập
                $_SESSION['user'] = [
                    'id'    => $user['id'],
                    'name'  => $user['fullname'],
                    'email' => $user['email'],
                    'role'  => $user['role']
                ];

                // Nếu là admin → vào admin dashboard
                if ($user['role'] === 'admin') {
                    header('Location: ' . BASE_URL . '/admin/dashboard');
                } else {
                    header('Location: ' . BASE_URL);
                }
                exit;
            } else {
                $error = 'Email hoặc mật khẩu không đúng';
                $this->view('auth/login', ['error' => $error]);
                return;
            }
        }

        $this->view('auth/login');
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fullname       = trim($_POST['fullname'] ?? '');
            $email          = trim($_POST['email'] ?? '');
            $password       = $_POST['password'] ?? '';
            $confirm        = $_POST['confirm_password'] ?? '';

            $errors = [];

            if ($password !== $confirm) {
                $errors[] = 'Mật khẩu xác nhận không khớp';
            }

            if ($this->userModel->findByEmail($email)) {
                $errors[] = 'Email đã được sử dụng';
            }

            if (empty($errors)) {
                // TỪ GIỜ TRỞ ĐI: luôn hash password theo chuẩn PHP
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $this->userModel->register([
                    'fullname' => $fullname,
                    'email'    => $email,
                    'password' => $hashedPassword
                ]);

                header('Location: ' . BASE_URL . '/auth/login');
                exit;
            }

            $this->view('auth/register', [
                'errors'   => $errors,
                'old'      => ['fullname' => $fullname, 'email' => $email]
            ]);
            return;
        }

        $this->view('auth/register');
    }

    public function logout()
    {
        unset($_SESSION['user']);
        session_destroy();
        header('Location: ' . BASE_URL);
        exit;
    }
}
