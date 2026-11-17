
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Control de Herramientas</title>


    <!-- ==========================================
         HOJA DE ESTILOS PRINCIPAL
         ========================================== -->
    <!--
        asset() genera la ruta automáticamente
        utilizando config/app.php.

        LOCAL:
        /App/app-base/assets/css/app.css

        HOSTING:
        /herramientas/assets/css/app.css
    -->

    <link rel="stylesheet"
        href="<?= htmlspecialchars(asset('css/app.css'), ENT_QUOTES, 'UTF-8') ?>">

        <!-- Bootstrap Icons -->
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

</head>

<body>

    <!-- ==========================================
         ESTRUCTURA PRINCIPAL DE LA APLICACIÓN
         ========================================== -->

    <div class="app">

        <!-- SIDEBAR -->
        <?php
        require __DIR__ . '/../components/sidebar.php';
        ?>


        <!-- OVERLAY DEL SIDEBAR -->
        <div
            class="sidebar-overlay"
            id="sidebarOverlay"></div>


        <!-- CONTENIDO PRINCIPAL -->
        <div class="app__main">

            <!-- NAVBAR -->
            <?php
            require __DIR__ . '/../components/navbar.php';
            ?>


            <!-- WORKSPACE -->
            <main
                class="workspace"
                id="workspace">

                <?= $content ?>

            </main>

        </div>

    </div>


    <!-- ==========================================
         CONFIGURACIÓN GLOBAL DE JAVASCRIPT
         ========================================== -->

    <!--
        Compartimos la ruta base de PHP con JavaScript.

        Esto permite que los módulos JS conozcan
        la ubicación donde está instalada la aplicación.

        Ejemplos:

        LOCAL:
        window.APP_BASE_PATH = "/App/app-base";

        HOSTING:
        window.APP_BASE_PATH = "/herramientas";
    -->

    <script>
        window.APP_BASE_PATH = <?= json_encode(
            base_path(),
            JSON_HEX_TAG |
            JSON_HEX_AMP |
            JSON_HEX_APOS |
            JSON_HEX_QUOT
        ) ?>;
    </script>


    <!-- ==========================================
         JAVASCRIPT PRINCIPAL
         ========================================== -->

    <!--
        asset() genera la ruta correcta de app.js
        según el entorno donde esté instalada APP-BASE.
    -->

    <script
        type="module"
        src="<?= htmlspecialchars(asset('js/app.js'), ENT_QUOTES, 'UTF-8') ?>">
    </script>

</body>

</html>
