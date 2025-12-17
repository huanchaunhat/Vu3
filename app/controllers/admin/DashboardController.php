<?php
// app/controllers/admin/DashboardController.php
require_once __DIR__ . '/BaseAdminController.php';

class DashboardController extends BaseAdminController
{
    public function index()
    {
        $this->view('admin/dashboard/index');
    }
}
