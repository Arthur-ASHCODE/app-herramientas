<?php

class AuthController
{
    public function login(): void
    {
        ob_start();

        require __DIR__ . '/../Views/auth/login.php';

        $content = ob_get_clean();

        require __DIR__ . '/../Views/layouts/auth.php';
    }
}



