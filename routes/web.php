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

$router->get('/modulo01', function () {

    require_once __DIR__ . '/../app/Controllers/ModuloController.php';

    $controller = new ModuloController();

    $controller->modulo01();

});


$router->get('/modulo02', function () {

    require_once __DIR__ . '/../app/Controllers/ModuloController.php';

    $controller = new ModuloController();
    $controller->modulo02();

});


$router->get('/modulo03', function () {

    require_once __DIR__ . '/../app/Controllers/ModuloController.php';

    $controller = new ModuloController();
    $controller->modulo03();

});
