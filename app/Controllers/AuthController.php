
<?php

// ======================================================
// AUTHCONTROLLER - CONTROL DE AUTENTICACIÓN
// ======================================================

// Clase encargada de administrar:
// - Visualización del Login.
// - Validación de credenciales.
// - Inicio de sesión.
// - Cierre de sesión.
// - Protección CSRF.

// Cargar componentes de autenticación.
require_once __DIR__ . '/../Core/Auth.php';
require_once __DIR__ . '/../Models/Usuario.php';


class AuthController
{

    // ==================================================
    // 1. MOSTRAR FORMULARIO LOGIN
    // ==================================================

    public function login(): void
    {
        // Inicializar la sesión PHP.
        Auth::start();


        // Si el usuario ya está autenticado,
        // enviarlo directamente al Dashboard.
        if (Auth::check()) {

            header('Location: ' . url('dashboard'));

            exit;
        }


        // Crear token CSRF para proteger el formulario.
        if (
            !isset($_SESSION['csrf_token']) ||
            !is_string($_SESSION['csrf_token']) ||
            $_SESSION['csrf_token'] === ''
        ) {

            $_SESSION['csrf_token'] = bin2hex(
                random_bytes(32)
            );

        }


        // Cargar la vista del formulario Login.
        ob_start();

        require __DIR__ . '/../Views/auth/login.php';

        $content = ob_get_clean();


        // Cargar el layout de autenticación.
        require __DIR__ . '/../Views/layouts/auth.php';
    }



    // ==================================================
    // 2. PROCESAR USUARIO Y CONTRASEÑA
    // ==================================================

    public function authenticate(): void
    {
        // Inicializar sesión.
        Auth::start();


        // --------------------------------------------------
        // VALIDAR TOKEN CSRF
        // --------------------------------------------------

        $token = $_POST['csrf_token'] ?? null;

        $sessionToken = $_SESSION['csrf_token'] ?? null;


        // Ambos tokens deben existir y ser cadenas.
        if (
            !is_string($token) ||
            !is_string($sessionToken) ||
            $token === '' ||
            $sessionToken === '' ||
            !hash_equals($sessionToken, $token)
        ) {

            http_response_code(403);

            echo 'Solicitud no válida.';

            return;
        }


        // --------------------------------------------------
        // OBTENER CREDENCIALES
        // --------------------------------------------------

        $usuario = trim(
            (string) ($_POST['user'] ?? '')
        );

        $password = (string) (
            $_POST['password'] ?? ''
        );


        // --------------------------------------------------
        // VALIDAR CAMPOS OBLIGATORIOS
        // --------------------------------------------------

        if ($usuario === '' || $password === '') {

            $_SESSION['login_error'] =
                'Completa todos los campos.';

            header('Location: ' . url('login'));

            exit;
        }


        // --------------------------------------------------
        // BUSCAR USUARIO EN MYSQL
        // --------------------------------------------------

        // El modelo Usuario debe realizar esta consulta
        // mediante PDO y sentencias preparadas.

        $registro = Usuario::buscarPorUsuario($usuario);


        // --------------------------------------------------
        // VERIFICAR CREDENCIALES
        // --------------------------------------------------

        // Validar:
        // 1. Que el usuario exista.
        // 2. Que esté activo.
        // 3. Que la contraseña coincida con su hash.

        if (
            !$registro ||
            (int) $registro['estatus'] !== 1 ||
            !password_verify(
                $password,
                $registro['password']
            )
        ) {

            $_SESSION['login_error'] =
                'Usuario o contraseña incorrectos.';

            header('Location: ' . url('login'));

            exit;
        }


        // --------------------------------------------------
        // INICIAR SESIÓN
        // --------------------------------------------------

        // Guardar los datos autorizados del usuario
        // mediante la clase Auth.

        Auth::login($registro);


        // Eliminar el token utilizado en el Login.
        unset($_SESSION['csrf_token']);


        // --------------------------------------------------
        // REDIRIGIR AL DASHBOARD
        // --------------------------------------------------

        header('Location: ' . url('dashboard'));

        exit;
    }



    // ==================================================
    // 3. CERRAR SESIÓN
    // ==================================================

    public function logout(): void
    {
        // Inicializar sesión.
        Auth::start();


        // --------------------------------------------------
        // VALIDAR TOKEN CSRF
        // --------------------------------------------------

        $token = $_POST['csrf_token'] ?? null;

        $sessionToken = $_SESSION['csrf_token'] ?? null;


        if (
            !is_string($token) ||
            !is_string($sessionToken) ||
            $token === '' ||
            $sessionToken === '' ||
            !hash_equals($sessionToken, $token)
        ) {

            http_response_code(403);

            echo 'Solicitud no válida.';

            return;
        }


        // --------------------------------------------------
        // DESTRUIR SESIÓN
        // --------------------------------------------------

        Auth::logout();


        // --------------------------------------------------
        // REGRESAR AL LOGIN
        // --------------------------------------------------

        header('Location: ' . url('login'));

        exit;
    }

}
