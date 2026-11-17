
<?php

// ======================================================
// FUNCIONES AUXILIARES PARA LAS RUTAS DE APP-BASE
// ======================================================


// ------------------------------------------------------
// 1. OBTENER LA RUTA BASE DE LA APLICACIÓN
// ------------------------------------------------------

function base_path(): string
{
    // Almacena la ruta base durante la solicitud.
    static $base = null;

    if ($base === null) {

        // Leer la configuración de config/app.php.
        $config = require __DIR__ . '/../../config/app.php';

        // Eliminar diagonales sobrantes.
        $path = trim($config['base_path'] ?? '', '/');

        // Construir la ruta base normalizada.
        $base = $path === '' ? '' : '/' . $path;
    }

    return $base;
}


// ------------------------------------------------------
// 2. GENERAR URLS INTERNAS
// ------------------------------------------------------

function url(string $path = ''): string
{
    // Obtener la ruta base.
    $base = base_path();

    // Eliminar diagonales iniciales del destino.
    $path = ltrim($path, '/');

    // Si no se especifica destino, devolver inicio.
    if ($path === '') {
        return $base . '/';
    }

    // Construir la URL interna.
    return $base . '/' . $path;
}


// ------------------------------------------------------
// 3. GENERAR RUTAS DE RECURSOS PÚBLICOS
// ------------------------------------------------------

function asset(string $path): string
{
    // Generar la URL de archivos CSS, JS e imágenes.
    return url('assets/' . ltrim($path, '/'));
}
