
<?php

// ======================================================
// RUTAS PRINCIPALES - APP-BASE
// ======================================================

// Este archivo registra las rutas de la aplicación.
//
// GET  -> Consultar o mostrar información.
// POST -> Enviar y procesar información.
//
// Las rutas son independientes del entorno.
//
// LOCAL:   /App/app-base
// HOSTING: /herramientas


// ======================================================
// 1. RUTA PRINCIPAL
// ======================================================

$router->get('/', function () {

    require_once __DIR__ . '/../app/Core/Auth.php';

    // Comprobar si el usuario está autenticado.
    if (Auth::check()) {

        header('Location: ' . url('dashboard'));

    } else {

        header('Location: ' . url('login'));

    }

    exit;

});


// ======================================================
// 2. AUTENTICACIÓN - LOGIN
// ======================================================

// ------------------------------------------------------
// GET /login
// Mostrar formulario de inicio de sesión.
// ------------------------------------------------------

$router->get('/login', function () {

    require_once __DIR__ . '/../app/Controllers/AuthController.php';

    $controller = new AuthController();

    $controller->login();

});


// ------------------------------------------------------
// POST /login
// Procesar usuario, contraseña y token CSRF.
// ------------------------------------------------------

$router->post('/login', function () {

    require_once __DIR__ . '/../app/Controllers/AuthController.php';

    $controller = new AuthController();

    $controller->authenticate();

});


// ======================================================
// 3. AUTENTICACIÓN - LOGOUT
// ======================================================

// ------------------------------------------------------
// POST /logout
// Cerrar sesión del usuario autenticado.
// ------------------------------------------------------

$router->post('/logout', function () {

    require_once __DIR__ . '/../app/Controllers/AuthController.php';

    $controller = new AuthController();

    $controller->logout();

});


// ======================================================
// 4. DASHBOARD
// ======================================================

// ------------------------------------------------------
// GET /dashboard
// Mostrar panel principal.
// ------------------------------------------------------

$router->get('/dashboard', function () {

    require_once __DIR__ . '/../app/Core/Auth.php';

    // Impedir acceso sin autenticación.
    Auth::requireLogin();

    require_once __DIR__ . '/../app/Controllers/DashboardController.php';

    $controller = new DashboardController();

    $controller->index();

});


// ======================================================
// 5. MÓDULO 01
// ======================================================

$router->get('/modulo01', function () {

    require_once __DIR__ . '/../app/Core/Auth.php';

    Auth::requireLogin();

    require_once __DIR__ . '/../app/Controllers/ModuloController.php';

    $controller = new ModuloController();

    $controller->modulo01();

});


// ======================================================
// 6. MÓDULO 02
// ======================================================

$router->get('/modulo02', function () {

    require_once __DIR__ . '/../app/Core/Auth.php';

    Auth::requireLogin();

    require_once __DIR__ . '/../app/Controllers/ModuloController.php';

    $controller = new ModuloController();

    $controller->modulo02();

});


// ======================================================
// 7. MÓDULO 03
// ======================================================

$router->get('/modulo03', function () {

    require_once __DIR__ . '/../app/Core/Auth.php';

    Auth::requireLogin();

    require_once __DIR__ . '/../app/Controllers/ModuloController.php';

    $controller = new ModuloController();

    $controller->modulo03();

});
