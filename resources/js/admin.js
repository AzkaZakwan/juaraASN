document.addEventListener("DOMContentLoaded", () => {

    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("sidebarOverlay");

    const openBtn = document.getElementById("openSidebar");
    const closeBtn = document.getElementById("closeSidebar");

    openBtn?.addEventListener("click", () => {
        sidebar?.classList.remove("-translate-x-full");
        overlay?.classList.remove("hidden");
    });

    closeBtn?.addEventListener("click", closeSidebar);
    overlay?.addEventListener("click", closeSidebar);

    function closeSidebar() {
        sidebar?.classList.add("-translate-x-full");
        overlay?.classList.add("hidden");
    }

    const btnBackPage = document.getElementById("btnBackPage");

    btnBackPage?.addEventListener("click", () => {
        window.history.back();
    });

});