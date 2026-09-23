<?php

class Router
{
    private array $routes = [];

    public function get(string $uri, callable $callback): void
    {
        $this->routes['GET'][$uri] = $callback;
    }

    public function resolve(): void
    {
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $basePath = '/App/app-base';
        $uri = str_replace($basePath, '', $requestUri);

        $uri = '/' . trim($uri, '/');

        if ($uri === '//') {
            $uri = '/';
        }

        $method = $_SERVER['REQUEST_METHOD'];

        if (isset($this->routes[$method][$uri])) {
            call_user_func($this->routes[$method][$uri]);
            return;
        }

        http_response_code(404);
        echo '404 - Página no encontrada';
    }
}