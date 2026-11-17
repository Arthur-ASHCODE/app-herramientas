<?php
// ======================================================
// LAYOUT DE AUTENTICACIÓN
// ======================================================
// Verificar que exista el contenido de la vista.
// Si no existe, inicializarlo como una cadena vacía.
if (!isset($content)) {
    $content = '';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- ==========================================
         HOJA DE ESTILOS PRINCIPAL
         ========================================== -->
    <!--
        asset() genera automáticamente la ruta
        correcta según config/app.php.
        LOCAL:
        /App/app-base/assets/css/app.css
        HOSTING:
        /herramientas/assets/css/app.css
    -->
    <link
        rel="stylesheet"
        href="<?= htmlspecialchars(asset('css/app.css'), ENT_QUOTES, 'UTF-8') ?>">
    <title>App Herramientas | Iniciar sesión</title>
</head>
<body>
    <!-- ==========================================
         CONTENIDO DE LA VISTA LOGIN
         ========================================== -->
    <?= $content ?>
</body>
</html>
