<?php

// Cargar las funciones auxiliares.
require_once __DIR__ . '/../app/Core/helpers.php';

// Cargar el enrutador.
require_once __DIR__ . '/../app/Core/Router.php';

// Crear una instancia del Router.
$router = new Router();

// Registrar las rutas.
require_once __DIR__ . '/../routes/web.php';

// Resolver la solicitud.
$router->resolve();