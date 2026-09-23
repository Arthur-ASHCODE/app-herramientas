<?php

$router->get('/', function () {
    echo 'Inicio de App Herramientas';
});

$router->get('/login', function () {

    require_once __DIR__ . '/../app/Controllers/AuthController.php';

    $controller = new AuthController();
    $controller->login();

});

$router->get('/dashboard', function () {

    require_once __DIR__ . '/../app/Controllers/DashboardController.php';

    $controller = new DashboardController();
    $controller->index();

});

$router->get('/section-1', function () {
    echo 'Sección 1';
});

$router->get('/section-2', function () {
    echo 'Sección 2';
});

$router->get('/section-3', function () {
    echo 'Sección 3';
});

$router->get('/section-3', function () {
    echo 'Sección 3';
});