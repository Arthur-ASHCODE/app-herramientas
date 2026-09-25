<?php
class DashboardController
{
    public function index(): void
    {
        // Detectamos si la petición viene de fetch()
        $isFetch = isset($_SERVER['HTTP_X_REQUESTED_WITH'])
            && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'fetch';


        // Si viene de fetch, devolvemos solo la vista
        if ($isFetch) {

            require __DIR__ . '/../Views/dashboard/index.php';

            return;
        }


        // Navegación normal: cargamos vista + layout
        ob_start();

        require __DIR__ . '/../Views/dashboard/index.php';

        $content = ob_get_clean();

        require __DIR__ . '/../Views/layouts/app.php';
    }
}