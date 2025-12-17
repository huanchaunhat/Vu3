<?php

class ProductController extends Controller
{
    private $productModel;
    private $categoryModel;

    public function __construct()
    {
        $this->productModel  = $this->model('Product');
        $this->categoryModel = $this->model('Category');
    }

    public function index()
    {
        $products = $this->productModel->getAll();
        $this->view('admin/products/index', ['products' => $products]);
    }

    public function create()
    {
        $categories = $this->categoryModel->getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $imageName = $this->uploadImage();

            $data = [
                'productname' => $_POST['productname'],
                'price'       => $_POST['price'],
                'quantity'    => $_POST['quantity'],
                'categoryid'  => $_POST['categoryid'],
                'description' => $_POST['description'],
                'detail'      => $_POST['detail'],
                'status'      => $_POST['status'],
                'image'       => $imageName
            ];

            $this->productModel->create($data);
            header("Location: " . BASE_URL . "/admin/product");
            exit;
        }

        $this->view('admin/products/create', ['categories' => $categories]);
    }

    public function edit($id)
    {
        $product = $this->productModel->find($id);
        $categories = $this->categoryModel->getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Nếu upload ảnh mới
            if (!empty($_FILES['image']['name'])) {
                $imageName = $this->uploadImage();
            } else {
                $imageName = $product['image'];
            }

            $data = [
                'productname' => $_POST['productname'],
                'price'       => $_POST['price'],
                'quantity'    => $_POST['quantity'],
                'categoryid'  => $_POST['categoryid'],
                'description' => $_POST['description'],
                'detail'      => $_POST['detail'],
                'status'      => $_POST['status'],
                'image'       => $imageName
            ];

            $this->productModel->update($id, $data);

            header("Location: " . BASE_URL . "/admin/product");
            exit;
        }

        $this->view('admin/products/edit', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    public function delete($id)
    {
        $this->productModel->deleteById($id);
        header("Location: " . BASE_URL . "/admin/product");
        exit;
    }

    private function uploadImage()
    {
        if (!empty($_FILES['image']['name'])) {

            $file = $_FILES['image'];
            $name = time() . "_" . basename($file['name']);

            // Dẫn đúng đến thư mục public/uploads/products
            $targetPath = dirname(__DIR__, 3) . "/public/uploads/products/" . $name;

            /** Tạo thư mục uploads/products nếu chưa có */
            if (!is_dir(dirname(__DIR__, 3) . "/public/uploads/products")) {
                mkdir(dirname(__DIR__, 3) . "/public/uploads/products", 0777, true);
            }

            if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                return $name;
            }
        }
        return '';
    }
}
