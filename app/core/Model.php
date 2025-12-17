<?php
// app/core/Model.php
require_once __DIR__ . '/../config/config.php';

class Model
{
    protected $db;

    public function __construct()
    {
        // Lấy kết nối PDO dùng chung
        $this->db = getPDO();
    }
}
