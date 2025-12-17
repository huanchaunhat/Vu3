<?php
// app/controllers/ProductController.php

class ProductController extends Controller
{
    private $productModel;
    private $categoryModel;
    private $commentModel;

    public function __construct()
    {
        // khởi tạo các model dùng chung
        $this->productModel  = $this->model('Product');
        $this->categoryModel = $this->model('Category');
        $this->commentModel  = $this->model('Comment');
    }

    public function index()
    {
        // Lấy bộ lọc từ query string
        $filters = [
            'keyword'    => $_GET['keyword']    ?? '',
            'categoryid' => $_GET['categoryid'] ?? '',
            'min_price'  => $_GET['min_price']  ?? '',
            'max_price'  => $_GET['max_price']  ?? '',
        ];

        // Lấy danh sách sản phẩm theo bộ lọc
        $products = $this->productModel->getFilteredProducts($filters);

        // Lấy danh sách hãng (categories) cho combobox
        // ==> DÙNG CategoryModel chứ không phải ProductModel
        // Nhớ trong Category model phải có hàm getAll() (hoặc bạn đổi tên cho khớp)
        $categories = $this->categoryModel->getAll();

        // Đổ ra view
        $this->view('products/index', [
            'products'   => $products,
            'categories' => $categories,
            'filters'    => $filters,
        ]);
    }

    public function detail($id)
    {
        $product = $this->productModel->find($id);

        if (!$product) {
            header('Location: ' . BASE_URL);
            exit;
        }

        // xử lý gửi comment
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_SESSION['user'])) {
            $content = trim($_POST['content'] ?? '');
            $rate    = (int)($_POST['rate'] ?? 5);

            if ($content !== '') {
                $this->commentModel->add($id, $_SESSION['user']['id'], $content, $rate);
            }
        }

        $comments = $this->commentModel->getByProduct($id);

        $this->view('products/detail', [
            'product'  => $product,
            'comments' => $comments,
        ]);
    }
}
