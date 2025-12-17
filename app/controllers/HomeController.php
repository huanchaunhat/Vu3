<?php
// app/controllers/HomeController.php

class HomeController extends Controller
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
        $hotProducts  = $this->productModel->getHotProducts(8);
        $categories   = $this->categoryModel->getAll();

        $this->view('home/index', [
            'hotProducts' => $hotProducts,
            'categories'  => $categories
        ]);
    }
}
