
<?php

// ======================================================
// ROUTER PRINCIPAL DE APP-BASE
// ======================================================

// Clase encargada de registrar y resolver
// las rutas de nuestra aplicación MVC.

class Router
{
    // Almacena las rutas registradas.
    //
    // Ejemplo:
    // $routes['GET']['/login']
    // $routes['POST']['/login']

    private array $routes = [];


    // ==================================================
    // 1. REGISTRAR RUTAS GET
    // ==================================================

    // GET se utiliza normalmente para solicitar páginas
    // o consultar información.

    public function get(string $uri, callable $callback): void
    {
        // Normalizar la ruta antes de registrarla.
        $uri = '/' . trim($uri, '/');

        // Guardar la función asociada a la ruta GET.
        $this->routes['GET'][$uri] = $callback;
    }


    // ==================================================
    // 2. REGISTRAR RUTAS POST
    // ==================================================

    // POST se utiliza para enviar información al servidor.
    //
    // Ejemplos:
    // - Iniciar sesión.
    // - Registrar herramientas.
    // - Guardar préstamos.

    public function post(string $uri, callable $callback): void
    {
        // Normalizar la ruta.
        $uri = '/' . trim($uri, '/');

        // Guardar la función asociada a la ruta POST.
        $this->routes['POST'][$uri] = $callback;
    }


    // ==================================================
    // 3. RESOLVER LA RUTA SOLICITADA
    // ==================================================

    public function resolve(): void
    {
        // ----------------------------------------------
        // PASO 1. OBTENER LA URL SOLICITADA
        // ----------------------------------------------

        // Extraer la ruta sin los parámetros GET.
        //
        // Ejemplo:
        // /App/app-base/login?test=1
        //
        // Resultado:
        // /App/app-base/login

        $requestUri = parse_url(
            $_SERVER['REQUEST_URI'] ?? '/',
            PHP_URL_PATH
        );

        // Garantizar que tenemos una cadena válida.
        if (!is_string($requestUri)) {
            $requestUri = '/';
        }


        // ----------------------------------------------
        // PASO 2. OBTENER LA RUTA BASE
        // ----------------------------------------------

        // La función base_path() obtiene la configuración
        // definida en config/app.php.
        //
        // LOCAL:
        // /App/app-base
        //
        // HOSTING:
        // /herramientas

        $basePath = base_path();


        // ----------------------------------------------
        // PASO 3. ELIMINAR LA RUTA BASE
        // ----------------------------------------------

        // Solo eliminamos el prefijo si coincide
        // exactamente con el inicio de la ruta.
        //
        // Evitamos utilizar str_replace(), porque podría
        // eliminar coincidencias en otras partes de la URL.

        if ($basePath !== '') {

            if ($requestUri === $basePath) {

                // Solicitud a la raíz de la aplicación.
                $requestUri = '/';

            } elseif (
                str_starts_with(
                    $requestUri,
                    $basePath . '/'
                )
            ) {

                // Eliminar únicamente el prefijo inicial.
                $requestUri = substr(
                    $requestUri,
                    strlen($basePath)
                );

            } else {

                // La URL no pertenece a la ruta base.
                http_response_code(404);

                echo '404 - Página no encontrada';

                return;
            }
        }


        // ----------------------------------------------
        // PASO 4. NORMALIZAR LA RUTA
        // ----------------------------------------------

        // Ejemplos:
        //
        // /dashboard/ -> /dashboard
        // /modulo01/  -> /modulo01
        // /           -> /

        $uri = '/' . trim($requestUri, '/');


        // ----------------------------------------------
        // PASO 5. IDENTIFICAR EL MÉTODO HTTP
        // ----------------------------------------------

        // Detectar si la solicitud utiliza GET o POST.

        $method = strtoupper(
            $_SERVER['REQUEST_METHOD'] ?? 'GET'
        );


        // ----------------------------------------------
        // PASO 6. BUSCAR LA RUTA REGISTRADA
        // ----------------------------------------------

        // Comprobar si existe una función asociada
        // al método HTTP y a la ruta solicitada.

        if (isset($this->routes[$method][$uri])) {

            // Ejecutar la función correspondiente.
            //
            // Ejemplo:
            //
            // GET /login
            // AuthController->login()
            //
            // POST /login
            // AuthController->authenticate()

            call_user_func(
                $this->routes[$method][$uri]
            );

            return;
        }


        // ----------------------------------------------
        // PASO 7. RUTA NO ENCONTRADA
        // ----------------------------------------------

        // Si no existe una ruta registrada,
        // devolver un error HTTP 404.

        http_response_code(404);

        echo '404 - Página no encontrada';
    }
}
