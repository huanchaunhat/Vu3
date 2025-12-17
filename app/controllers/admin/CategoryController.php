<?php
// app/controllers/admin/CategoryController.php
require_once __DIR__ . '/BaseAdminController.php';

class CategoryController extends BaseAdminController
{
    private $categoryModel;

    public function __construct()
    {
        parent::__construct();
        $this->categoryModel = $this->model('Category');
    }

    public function index()
    {
        $categories = $this->categoryModel->getAllAdmin();
        $this->view('admin/categories/index', compact('categories'));
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'categoryname' => $_POST['categoryname'] ?? '',
                'description'  => $_POST['description'] ?? '',
                'status'       => isset($_POST['status']) ? 1 : 0
            ];
            $this->categoryModel->create($data);
            header('Location: ' . BASE_URL . '/admin/category/index');
            exit;
        }

        $this->view('admin/categories/form');
    }

    public function edit($id)
    {
        $category = $this->categoryModel->find($id);
        if (!$category) {
            header('Location: ' . BASE_URL . '/admin/category/index');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'categoryname' => $_POST['categoryname'] ?? '',
                'description'  => $_POST['description'] ?? '',
                'status'       => isset($_POST['status']) ? 1 : 0
            ];
            $this->categoryModel->updateCategory($id, $data);
            header('Location: ' . BASE_URL . '/admin/category/index');
            exit;
        }

        $this->view('admin/categories/form', compact('category'));
    }

    public function delete($id)
    {
        $this->categoryModel->deleteCategory($id);
        header('Location: ' . BASE_URL . '/admin/category/index');
        exit;
    }
}
