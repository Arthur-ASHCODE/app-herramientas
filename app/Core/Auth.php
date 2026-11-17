
<?php

// ======================================================
// AUTH - ADMINISTRACIÓN DE SESIONES
// ======================================================

// Clase encargada de:
// - Inicializar sesiones PHP.
// - Verificar autenticación.
// - Proteger rutas privadas.
// - Registrar usuarios autenticados.
// - Cerrar sesiones de forma segura.

class Auth
{

    // ==================================================
    // 1. INICIALIZAR SESIÓN
    // ==================================================

    public static function start(): void
    {
        // Evitar iniciar una sesión que ya está activa.
        if (session_status() === PHP_SESSION_ACTIVE) {
            return;
        }

        // Determinar si la conexión utiliza HTTPS.
        $https = (
            !empty($_SERVER['HTTPS']) &&
            $_SERVER['HTTPS'] !== 'off'
        );

        // Obtener la ruta base de APP-BASE.
        //
        // LOCAL:
        // /App/app-base/
        //
        // HOSTING:
        // /herramientas/

        $cookiePath = base_path() . '/';

        // Inicializar sesión con opciones de seguridad.
        session_start([

            // Rechazar identificadores de sesión
            // que no hayan sido generados por PHP.
            'use_strict_mode' => 1,

            // Utilizar únicamente cookies para
            // transmitir el identificador de sesión.
            'use_only_cookies' => 1,

            // Evitar acceso a la cookie desde JavaScript.
            'cookie_httponly' => 1,

            // Reducir el riesgo de solicitudes
            // entre sitios.
            'cookie_samesite' => 'Lax',

            // Enviar la cookie únicamente por HTTPS
            // cuando la conexión sea segura.
            'cookie_secure' => $https,

            // Limitar la cookie a la aplicación.
            'cookie_path' => $cookiePath

        ]);
    }



    // ==================================================
    // 2. VERIFICAR AUTENTICACIÓN
    // ==================================================

    public static function check(): bool
    {
        self::start();

        // Verificar que exista un identificador
        // de usuario válido en la sesión.
        return (
            isset($_SESSION['usuario_id']) &&
            is_numeric($_SESSION['usuario_id']) &&
            (int) $_SESSION['usuario_id'] > 0
        );
    }



    // ==================================================
    // 3. PROTEGER RUTAS PRIVADAS
    // ==================================================

    public static function requireLogin(): void
    {
        // Si existe una sesión válida,
        // permitir continuar.
        if (self::check()) {
            return;
        }

        // Identificar solicitudes SPA mediante fetch.
        $isFetch = (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            $_SERVER['HTTP_X_REQUESTED_WITH'] === 'fetch'
        );

        // Las solicitudes SPA deben recibir HTTP 401.
        // router.js detectará este código y enviará
        // al usuario a la pantalla de Login.
        if ($isFetch) {

            http_response_code(401);

            header('Content-Type: text/plain; charset=UTF-8');

            echo 'Sesión no válida o expirada.';

            exit;
        }

        // Para navegación tradicional, redirigir
        // directamente al formulario Login.
        header('Location: ' . url('login'));

        exit;
    }



    // ==================================================
    // 4. INICIAR SESIÓN DEL USUARIO
    // ==================================================

    public static function login(array $usuario): void
    {
        self::start();

        // Regenerar el identificador para prevenir
        // ataques de fijación de sesión.
        session_regenerate_id(true);

        // Guardar únicamente la información necesaria.
        // Nunca almacenar la contraseña ni su hash
        // dentro de la sesión.

        $_SESSION['usuario_id'] = (int) $usuario['id'];

        $_SESSION['usuario_nombre'] = (string) $usuario['nombre'];

    }



    // ==================================================
    // 5. CERRAR SESIÓN
    // ==================================================

    public static function logout(): void
    {
        self::start();

        // Eliminar las variables de sesión.
        $_SESSION = [];


        // Eliminar la cookie del navegador.
        if (ini_get('session.use_cookies')) {

            $params = session_get_cookie_params();

            setcookie(session_name(), '', [

                'expires' => time() - 3600,

                'path' => $params['path'],

                'domain' => $params['domain'],

                'secure' => $params['secure'],

                'httponly' => $params['httponly'],

                'samesite' => $params['samesite'] ?: 'Lax'

            ]);

        }


        // Destruir la sesión del servidor.
        session_destroy();
    }

}
