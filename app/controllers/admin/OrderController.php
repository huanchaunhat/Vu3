<?php
// app/controllers/admin/OrderController.php
require_once __DIR__ . '/BaseAdminController.php';

class OrderController extends BaseAdminController
{
    private $orderModel;

    public function __construct()
    {
        parent::__construct();
        $this->orderModel = $this->model('Order');
    }

    public function index()
    {
        $orders = $this->orderModel->getAll();
        $this->view('admin/orders/index', compact('orders'));
    }

    public function detail($id)
    {
        $order   = $this->orderModel->find($id);
        $details = $this->orderModel->getOrderDetails($id);

        if (!$order) {
            header('Location: ' . BASE_URL . '/admin/order/index');
            exit;
        }

        $this->view('admin/orders/detail', compact('order', 'details'));
    }

    public function updateStatus($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $status = $_POST['status'] ?? 'processing';
            $this->orderModel->updateStatus($id, $status);
        }

        header('Location: ' . BASE_URL . '/admin/order/detail/' . $id);
        exit;
    }
}
