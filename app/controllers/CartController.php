<?php
// app/controllers/CartController.php

class CartController extends Controller
{
    private $cartModel;
    private $productModel;
    private $orderModel;
    private $orderDetailModel;

    public function __construct()
    {
        $this->cartModel        = $this->model('Cart');
        $this->productModel     = $this->model('Product');
        $this->orderModel       = $this->model('Order');
        $this->orderDetailModel = $this->model('OrderDetail');
    }

    private function requireLogin()
    {
        if (empty($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }
    }

    // POST /cart/add
    public function add()
    {
        $this->requireLogin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = (int)($_POST['product_id'] ?? 0);
            $qty       = (int)($_POST['quantity'] ?? 1);

            if ($productId > 0) {
                $this->cartModel->add($_SESSION['user']['id'], $productId, $qty);
            }
        }

        header('Location: ' . BASE_URL . '/cart');
        exit;
    }

    // GET /cart
    public function index()
    {
        $this->requireLogin();

        $items = $this->cartModel->getItems($_SESSION['user']['id']);
        $total = 0;

        foreach ($items as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $this->view('cart/index', [
            'items' => $items,
            'total' => $total
        ]);
    }

    // POST /cart/update
    public function update()
    {
        $this->requireLogin();

        if (!empty($_POST['quantities']) && is_array($_POST['quantities'])) {
            foreach ($_POST['quantities'] as $productId => $qty) {
                $this->cartModel->updateQty($_SESSION['user']['id'], (int)$productId, (int)$qty);
            }
        }

        header('Location: ' . BASE_URL . '/cart');
        exit;
    }

    // GET /cart/remove/{productId}
    public function remove($productId)
    {
        $this->requireLogin();

        $this->cartModel->removeItem($_SESSION['user']['id'], (int)$productId);

        header('Location: ' . BASE_URL . '/cart');
        exit;
    }

    // GET + POST /cart/checkout
    public function checkout()
    {
        $this->requireLogin();

        $userId = $_SESSION['user']['id'];
        $items  = $this->cartModel->getItems($userId);

        if (empty($items)) {
            header('Location: ' . BASE_URL . '/cart');
            exit;
        }

        $total = 0;
        foreach ($items as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $address = trim($_POST['address'] ?? '');
            $note    = trim($_POST['note'] ?? '');

            if ($address === '') {
                $error = 'Vui lòng nhập địa chỉ giao hàng';
                $this->view('cart/checkout', compact('items', 'total', 'error'));
                return;
            }

            $orderId = $this->orderModel->createOrder($userId, $address, $total, $note);

            foreach ($items as $item) {
                $this->orderDetailModel->addItem(
                    $orderId,
                    $item['productid'],
                    $item['quantity'],
                    $item['price']
                );
            }

            $this->cartModel->clear($userId);

            $this->view('cart/checkout_success', ['orderId' => $orderId]);
            return;
        }

        $this->view('cart/checkout', compact('items', 'total'));
    }
}
