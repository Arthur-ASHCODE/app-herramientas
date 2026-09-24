<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Control de Herramientas</title>

    <link
        rel="stylesheet"
        href="/App/app-base/assets/css/app.css">

</head>

<body>

    <div class="app">

        <?php
        require __DIR__ . '/../components/sidebar.php';
        ?>

        <div
            class="sidebar-overlay"
            id="sidebarOverlay"></div>


        <div class="app__main">

            <?php
            require __DIR__ . '/../components/navbar.php';
            ?>


            <main
                class="workspace"
                id="workspace">

                <?= $content ?>

            </main>

        </div>

    </div>

    <script type="module" src="/App/app-base/assets/js/app.js"></script>

</body>

</html>