const workspace = document.getElementById('workspace');
const links = document.querySelectorAll('.sidebar__link');


if (workspace && links.length > 0) {

    // ==========================================
// ACTUALIZAR ENLACE ACTIVO
// ==========================================

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

    // ==========================================
    // CARGAR CONTENIDO
    // ==========================================

    const loadContent = async (url) => {

        try {

            const response = await fetch(url, {
                headers: {
                    'X-Requested-With': 'fetch'
                }
            });

            if (!response.ok) {
                throw new Error(
                    `Error HTTP: ${response.status}`
                );
            }

            const html = await response.text();

            workspace.innerHTML = html;

        } catch (error) {

            console.error(
                'Error al cargar la sección:',
                error
            );

        }

    };


    // ==========================================
    // CLIC EN SIDEBAR
    // ==========================================

    links.forEach((link) => {

        link.addEventListener('click', async (event) => {

            event.preventDefault();

            const url = link.href;

            await loadContent(url);

            window.history.pushState(
                {},
                '',
                url
            );

            updateActiveLink();

        });

    });


    // ==========================================
    // ATRÁS / ADELANTE DEL NAVEGADOR
    // ==========================================

    window.addEventListener('popstate', () => {

    loadContent(window.location.href);

    updateActiveLink();

});

updateActiveLink();

}