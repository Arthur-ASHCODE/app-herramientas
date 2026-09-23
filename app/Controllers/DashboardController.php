<?php

class DashboardController
{
    public function index(): void
    {
        ob_start();

        require __DIR__ . '/../Views/dashboard/index.php';

        $content = ob_get_clean();

        require __DIR__ . '/../Views/layouts/app.php';
    }
}