const sidebar = document.getElementById('sidebar');
const sidebarToggle = document.getElementById('sidebarToggle');
const sidebarOverlay = document.getElementById('sidebarOverlay');

if (sidebar && sidebarToggle && sidebarOverlay) {

    // ==========================================
    // ABRIR SIDEBAR
    // ==========================================

    const openSidebar = () => {

        sidebar.classList.add('sidebar--open');
        sidebarOverlay.classList.add('sidebar-overlay--visible');

        sidebarToggle.setAttribute('aria-expanded', 'true');
    };


    // ==========================================
    // CERRAR SIDEBAR
    // ==========================================

    const closeSidebar = () => {

        sidebar.classList.remove('sidebar--open');
        sidebarOverlay.classList.remove('sidebar-overlay--visible');
        sidebarToggle.setAttribute('aria-expanded', 'false');
    };


    // ==========================================
    // ABRIR / CERRAR CON BOTÓN
    // ==========================================

    const toggleSidebar = () => {

        // El menú desplegable solo funciona en móvil
        if (window.innerWidth > 767) {
            return;
        }

        const isOpen = sidebar.classList.contains('sidebar--open');

        if (isOpen) {
            closeSidebar();
        } else {
            openSidebar();
        }
    };

    // ==========================================
    // BOTÓN HAMBURGUESA
    // ==========================================

    sidebarToggle.addEventListener('click', toggleSidebar);


    // ==========================================
    // CERRAR AL PRESIONAR EL OVERLAY
    // ==========================================

    sidebarOverlay.addEventListener('click', closeSidebar);


    // ==========================================
    // CERRAR AL SELECCIONAR UNA OPCIÓN
    // ==========================================

    const sidebarLinks = sidebar.querySelectorAll('.sidebar__link');

    sidebarLinks.forEach((link) => {

        link.addEventListener('click', () => {

            if (window.innerWidth <= 767) {
                closeSidebar();
            }

        });

    });


    // ==========================================
    // CERRAR CON TECLA ESC
    // ==========================================

    document.addEventListener('keydown', (event) => {

        if (event.key === 'Escape') {
            closeSidebar();
        }

    });


    // ==========================================
    // LIMPIAR ESTADO AL CAMBIAR DE TAMAÑO
    // ==========================================

    window.addEventListener('resize', () => {

        if (window.innerWidth > 767) {
            closeSidebar();
        }

    });

}