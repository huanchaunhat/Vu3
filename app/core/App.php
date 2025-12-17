<?php
// app/core/App.php

class App
{
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];
    protected $isAdmin = false;

    public function __construct()
    {
        $url = $this->parseUrl();

        // Check admin route: /admin/Controller/method/...
        if (isset($url[0]) && $url[0] === 'admin') {
            $this->isAdmin = true;
            array_shift($url); // bỏ 'admin'

            // controller
            $controllerName = !empty($url[0]) ? ucfirst($url[0]) . 'Controller' : 'DashboardController';

            if (file_exists(__DIR__ . '/../controllers/admin/' . $controllerName . '.php')) {
                $this->controller = $controllerName;
                array_shift($url);
            } else {
                $this->controller = 'DashboardController';
            }

            require_once __DIR__ . '/../controllers/admin/' . $this->controller . '.php';
        } else {
            // Route normal: /Controller/method/...
            if (!empty($url[0])) {
                $controllerName = ucfirst($url[0]) . 'Controller';
                if (file_exists(__DIR__ . '/../controllers/' . $controllerName . '.php')) {
                    $this->controller = $controllerName;
                    array_shift($url);
                }
            }

            require_once __DIR__ . '/../controllers/' . $this->controller . '.php';
        }

        $this->controller = new $this->controller;

        // Method
        if (!empty($url[0]) && method_exists($this->controller, $url[0])) {
            $this->method = $url[0];
            array_shift($url);
        }

        // Params
        $this->params = $url ? array_values($url) : [];

        // Gọi controller/method
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    protected function parseUrl()
    {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }
}
