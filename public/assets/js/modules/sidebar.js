const sidebar = document.getElementById('sidebar');
const sidebarToggle = document.getElementById('sidebarToggle');
const sidebarOverlay = document.getElementById('sidebarOverlay');

if (sidebar && sidebarToggle && sidebarOverlay) {

    const openSidebar = () => {
        sidebar.classList.add('sidebar--open');
        sidebarOverlay.classList.add('sidebar-overlay--visible');

        sidebarToggle.setAttribute('aria-expanded', 'true');
    };

    const closeSidebar = () => {
        sidebar.classList.remove('sidebar--open');
        sidebarOverlay.classList.remove('sidebar-overlay--visible');

        sidebarToggle.setAttribute('aria-expanded', 'false');
    };

    const toggleSidebar = () => {
        const isOpen = sidebar.classList.contains('sidebar--open');

        if (isOpen) {
            closeSidebar();
        } else {
            openSidebar();
        }
    };

    sidebarToggle.addEventListener('click', toggleSidebar);

    sidebarOverlay.addEventListener('click', closeSidebar);
}