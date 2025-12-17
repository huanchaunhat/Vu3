<?php
// app/controllers/admin/BaseAdminController.php

class BaseAdminController extends Controller
{
    public function __construct()
    {
        if (empty($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }
    }
}
