<?php
// app/models/User.php

class User extends Model
{
    protected $table = 'users';

    // Đăng ký
    public function register($data)
    {
        $sql = "INSERT INTO users (fullname, email, password, role, status)
                VALUES (:fullname, :email, :password, 'user', 1)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'fullname' => $data['fullname'],
            'email'    => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_BCRYPT),
        ]);
    }

    // Lấy user theo email
    public function findByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
