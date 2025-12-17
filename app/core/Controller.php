<?php

class Controller
{
    protected function model($model)
    {
        require_once __DIR__ . '/../models/' . $model . '.php';
        return new $model();
    }

    protected function view($view, $data = [])
    {
        extract($data);

        // Base view folder - đúng theo cây thư mục của bạn
        $baseViewPath = __DIR__ . '/../views/';

        // Nếu là view admin (phát hiện admin/ ...)
        if (strpos($view, 'admin/') === 0) {

            $header = $baseViewPath . 'layouts/admin_header.php';
            $footer = $baseViewPath . 'layouts/admin_footer.php';
            $viewFile = $baseViewPath . $view . '.php';

        } else {

            $header = $baseViewPath . 'layouts/header.php';
            $footer = $baseViewPath . 'layouts/footer.php';
            $viewFile = $baseViewPath . $view . '.php';

        }

        // Kiểm tra tồn tại file view
        if (!file_exists($viewFile)) {
            die("<h3>❌ View không tồn tại:</h3><pre>$viewFile</pre>");
        }

        // Kiểm tra header/footer
        if (!file_exists($header)) {
            die("<h3>❌ Header không tồn tại:</h3><pre>$header</pre>");
        }

        if (!file_exists($footer)) {
            die("<h3>❌ Footer không tồn tại:</h3><pre>$footer</pre>");
        }

        // Load layout + view
        require $header;
        require $viewFile;
        require $footer;
    }
}


