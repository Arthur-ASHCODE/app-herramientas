<?php

// Cargamos la clase Router
require_once __DIR__ . '/../app/Core/Router.php';

// Creamos una instancia del Router
$router = new Router();

// Cargamos las rutas de la aplicación
require_once __DIR__ . '/../routes/web.php';

// Analizamos la URL solicitada y ejecutamos la ruta correspondiente
$router->resolve();