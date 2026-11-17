
/* ======================================================
   ROUTER SPA - APP-BASE
====================================================== */

// Contenedor donde se muestran los módulos.
const workspace = document.getElementById('workspace');

// Enlaces del menú lateral.
const links = document.querySelectorAll('.sidebar__link');

// Ruta base definida desde layouts/app.php.
const BASE_PATH = window.APP_BASE_PATH ?? '';

// Controlador para cancelar peticiones anteriores.
let activeRequest = null;


// ======================================================
// GENERAR URL INTERNA
// ======================================================

const appUrl = (path = '') => {

    const cleanPath = String(path).replace(/^\/+/, '');

    return `${BASE_PATH}/${cleanPath}`;

};


// ======================================================
// ACTUALIZAR ENLACE ACTIVO
// ======================================================

const updateActiveLink = () => {

    const currentPath = window.location.pathname;

    links.forEach((link) => {

        const linkPath = new URL(link.href).pathname;

        link.classList.toggle(
            'sidebar__link--active',
            linkPath === currentPath
        );

    });

};


// ======================================================
// CARGAR CONTENIDO MEDIANTE FETCH
// ======================================================

const loadContent = async (url) => {

    // Cancelar la petición anterior, si existe.
    if (activeRequest) {
        activeRequest.abort();
    }

    const controller = new AbortController();

    activeRequest = controller;

    try {

        const response = await fetch(url, {

            method: 'GET',

            headers: {
                'X-Requested-With': 'fetch'
            },

            credentials: 'same-origin',

            signal: controller.signal

        });


        // Cuando implementemos el Login, una ruta
        // protegida podrá devolver HTTP 401.
        if (response.status === 401) {

            window.location.assign(appUrl('login'));

            return false;

        }


        // No permitir que una redirección inesperada
        // inserte una página completa en el workspace.
        if (response.redirected) {

            window.location.assign(response.url);

            return false;

        }


        // Comprobar si la respuesta fue exitosa.
        if (!response.ok) {

            throw new Error(
                `Error HTTP: ${response.status}`
            );

        }


        // Obtener el HTML generado por el controlador.
        const html = await response.text();

        // Evitar que una petición cancelada
        // modifique el contenido del workspace.
        if (controller.signal.aborted) {
            return false;
        }


        // Actualizar el contenido sin recargar.
        workspace.innerHTML = html;

        return true;


    } catch (error) {

        // Una cancelación no es un error de navegación.
        if (error.name === 'AbortError') {
            return false;
        }

        console.error(
            'Error al cargar la sección:',
            error
        );

        return false;

    } finally {

        if (activeRequest === controller) {
            activeRequest = null;
        }

    }

};


// ======================================================
// INICIALIZAR NAVEGACIÓN SPA
// ======================================================

if (workspace && links.length > 0) {

    // --------------------------------------------------
    // CLIC EN ENLACES DEL SIDEBAR
    // --------------------------------------------------

    links.forEach((link) => {

        link.addEventListener('click', async (event) => {

            // Permitir Ctrl + clic, Shift + clic,
            // apertura en nueva pestaña, etc.
            if (
                event.button !== 0 ||
                event.ctrlKey ||
                event.metaKey ||
                event.shiftKey ||
                event.altKey
            ) {
                return;
            }

            event.preventDefault();

            // El href ya contiene la URL correcta
            // generada por PHP mediante url().
            const targetUrl = link.href;

            // Evitar navegación innecesaria.
            if (targetUrl === window.location.href) {
                return;
            }

            const loaded = await loadContent(targetUrl);

            // Solo actualizar la URL si la carga
            // terminó correctamente.
            if (loaded) {

                window.history.pushState(
                    {},
                    '',
                    targetUrl
                );

                updateActiveLink();

            }

        });

    });


    // --------------------------------------------------
    // BOTONES ATRÁS Y ADELANTE
    // --------------------------------------------------

    window.addEventListener('popstate', async () => {

        const loaded = await loadContent(
            window.location.href
        );

        if (loaded) {
            updateActiveLink();
        }

    });


    // --------------------------------------------------
    // IDENTIFICAR ENLACE ACTIVO INICIAL
    // --------------------------------------------------

    updateActiveLink();

}
