<?php

// ======================================================
// SIDEBAR - PREPARACIÓN DE DATOS DEL USUARIO
// ======================================================

// La clase Auth administra las sesiones PHP.
require_once __DIR__ . '/../../Core/Auth.php';

// Garantizar que la sesión esté inicializada.
Auth::start();


// ======================================================
// 1. OBTENER NOMBRE DEL USUARIO
// ======================================================

// Recuperar el nombre almacenado al iniciar sesión.
$nombreUsuario = (string) (
    $_SESSION['usuario_nombre'] ?? 'Usuario'
);


// ======================================================
// 2. GENERAR INICIALES DEL AVATAR
// ======================================================

// Separar las palabras que forman el nombre.
$partesNombre = preg_split(
    '/\s+/u',
    trim($nombreUsuario),
    -1,
    PREG_SPLIT_NO_EMPTY
);

// Iniciales predeterminadas.
$iniciales = 'US';

if (!empty($partesNombre)) {

    // Primera letra del primer nombre.
    $primera = mb_substr(
        $partesNombre[0],
        0,
        1,
        'UTF-8'
    );

    // Primera letra de la segunda palabra,
    // si existe.
    $segunda = isset($partesNombre[1])
        ? mb_substr($partesNombre[1], 0, 1, 'UTF-8')
        : '';

    $iniciales = mb_strtoupper(
        $primera . $segunda,
        'UTF-8'
    );
}


// ======================================================
// 3. GENERAR TOKEN CSRF PARA CERRAR SESIÓN
// ======================================================

// El token utilizado en el Login se elimina
// después de autenticar al usuario.
//
// Por eso generamos uno nuevo para proteger
// el formulario de cierre de sesión.

if (
    !isset($_SESSION['csrf_token']) ||
    !is_string($_SESSION['csrf_token']) ||
    $_SESSION['csrf_token'] === ''
) {

    $_SESSION['csrf_token'] = bin2hex(
        random_bytes(32)
    );
}

?>


<!-- ======================================================
     SIDEBAR - MENÚ LATERAL DE APP-BASE
====================================================== -->

<aside class="sidebar" id="sidebar">

    <!-- ==================================================
         IDENTIDAD / LOGOTIPO
    ================================================== -->

    <div class="sidebar__brand">

        <img
            class="sidebar__logo"
            src="<?= htmlspecialchars(asset('img/logo/SSYPAZ.png'), ENT_QUOTES, 'UTF-8') ?>"
            alt="ASHCODE">

        <span class="sidebar__website">
            www.ashcode.com.mx
        </span>

    </div>


    <!-- ==================================================
         MENÚ DE NAVEGACIÓN
    ================================================== -->

    <nav class="sidebar__nav">

        <!-- DASHBOARD -->
        <a
            href="<?= htmlspecialchars(url('dashboard'), ENT_QUOTES, 'UTF-8') ?>"
            class="sidebar__link"
            data-route="/dashboard">

            <span class="sidebar__icon">
                <i class="bi bi-grid" aria-hidden="true"></i>
            </span>
            <span>Dashboard</span>

        </a>


        <!-- MÓDULO 01 -->
        <a
            href="<?= htmlspecialchars(url('modulo01'), ENT_QUOTES, 'UTF-8') ?>"
            class="sidebar__link"
            data-route="/modulo01">

            <span class="sidebar__icon">
                <i class="bi bi-square" aria-hidden="true"></i>
            </span>
            <span>Módulo 01</span>

        </a>


        <!-- MÓDULO 02 -->
        <a
            href="<?= htmlspecialchars(url('modulo02'), ENT_QUOTES, 'UTF-8') ?>"
            class="sidebar__link"
            data-route="/modulo02">

            <span class="sidebar__icon">
                <i class="bi bi-square" aria-hidden="true"></i>
            </span>
            <span>Módulo 02</span>

        </a>


        <!-- MÓDULO 03 -->
        <a
            href="<?= htmlspecialchars(url('modulo03'), ENT_QUOTES, 'UTF-8') ?>"
            class="sidebar__link"
            data-route="/modulo03">

            <span class="sidebar__icon">
                <i class="bi bi-square" aria-hidden="true"></i>
            </span>
            <span>Módulo 03</span>

        </a>

    </nav>


    <!-- ==================================================
         INFORMACIÓN DEL USUARIO
    ================================================== -->

    <div class="sidebar__footer">

        <!-- ==============================================
             DATOS DEL USUARIO AUTENTICADO
        ============================================== -->

        <div class="sidebar__user">

            <!-- Avatar -->
            <div class="sidebar__avatar">

                <?= htmlspecialchars(
                    $iniciales,
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>

            </div>


            <!-- Nombre y descripción -->
            <div class="sidebar__user-info">

                <strong>
                    <?= htmlspecialchars(
                        $nombreUsuario,
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>
                </strong>

                <span>Administrador</span>

            </div>

        </div>


        <!-- ==============================================
             BOTÓN CERRAR SESIÓN
        ============================================== -->

        <form
            class="sidebar__logout-form"
            action="<?= htmlspecialchars(url('logout'), ENT_QUOTES, 'UTF-8') ?>"
            method="POST">

            <!-- Token de protección CSRF -->
            <input
                type="hidden"
                name="csrf_token"
                value="<?= htmlspecialchars(
                            $_SESSION['csrf_token'],
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>">


            <!-- Botón de cierre de sesión -->
            <button
                class="sidebar__logout"
                type="submit"
                title="Cerrar sesión">

                <span
                    class="sidebar__logout-icon"
                    aria-hidden="true">
                    ⇥
                </span>

                <span class="sidebar__logout-text">
                    Cerrar sesión
                </span>

            </button>

        </form>

    </div>

</aside>