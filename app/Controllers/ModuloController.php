<?php

class ModuloController
{
    public function modulo01(): void
    {
        // Detectamos si la petición viene de fetch()
        $isFetch = isset($_SERVER['HTTP_X_REQUESTED_WITH'])
            && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'fetch';


        // Si viene de fetch(), cargamos solamente el módulo
        if ($isFetch) {

            require __DIR__ . '/../Views/modules/modulo01.php';

            return;
        }


        // Si es una petición normal, cargamos módulo + layout
        ob_start();

        require __DIR__ . '/../Views/modules/modulo01.php';

        $content = ob_get_clean();

        require __DIR__ . '/../Views/layouts/app.php';
    }

    public function modulo02(): void
    {
        // Detectamos si la petición viene de fetch()
        $isFetch = isset($_SERVER['HTTP_X_REQUESTED_WITH'])
            && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'fetch';


        // Si viene de fetch(), cargamos solamente el módulo
        if ($isFetch) {

            require __DIR__ . '/../Views/modules/modulo02.php';

            return;
        }


        // Si es una petición normal, cargamos módulo + layout
        ob_start();

        require __DIR__ . '/../Views/modules/modulo02.php';

        $content = ob_get_clean();

        require __DIR__ . '/../Views/layouts/app.php';
    }



    public function modulo03(): void
    {
        // Detectamos si la petición viene de fetch()
        $isFetch = isset($_SERVER['HTTP_X_REQUESTED_WITH'])
            && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'fetch';


        // Si viene de fetch(), cargamos solamente el módulo
        if ($isFetch) {

            require __DIR__ . '/../Views/modules/modulo03.php';

            return;
        }


        // Si es una petición normal, cargamos módulo + layout
        ob_start();

        require __DIR__ . '/../Views/modules/modulo03.php';

        $content = ob_get_clean();

        require __DIR__ . '/../Views/layouts/app.php';
    }



}