const toggle = document.getElementById("eyeIcon");
const password = document.getElementById("password");

if (toggle && password) {
    toggle.addEventListener("click", () => {
        const isHidden = password.type === "password";

        password.type = isHidden ? "text" : "password";

        toggle.innerHTML = isHidden
            ? '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" /></svg>'
            : '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>'
    });
}

const toggle2 = document.getElementById("eyeIcon2");
const password2 = document.getElementById("password2");

if (toggle2 && password2) {
    toggle2.addEventListener("click", () => {
        const isHidden = password2.type === "password";

        password2.type = isHidden ? "text" : "password";

        toggle2.innerHTML = isHidden
            ? '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" /></svg>'
            : '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>'
    });
}

document.addEventListener("DOMContentLoaded", () => {

    const menuBtn = document.getElementById("menuBtn");
    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("overlay");

    if (!menuBtn || !sidebar || !overlay) return;

    function openSidebar() {
        sidebar.classList.add("open");
        sidebar.classList.remove("-translate-x-full");

        overlay.classList.remove("hidden");
        setTimeout(() => {
            overlay.classList.remove("opacity-0");
        }, 10);
    }

    function closeSidebar() {
        sidebar.classList.remove("open");
        sidebar.classList.add("-translate-x-full");

        overlay.classList.add("opacity-0");
        setTimeout(() => {
            overlay.classList.add("hidden");
        }, 300);
    }

    // 🔥 TOGGLE BUTTON
    menuBtn.addEventListener("click", () => {
        if (sidebar.classList.contains("open")) {
            closeSidebar();
        } else {
            openSidebar();
        }
    });

    // klik luar (overlay)
    overlay.addEventListener("click", closeSidebar);

});
document.addEventListener("DOMContentLoaded", () => {
    let lastScroll = 0;

    const navbar = document.getElementById("navbar");
    if (!navbar) return;

    const inner = navbar.querySelector("div");

    window.addEventListener("scroll", () => {
        const currentScroll = window.scrollY;

        // 🔽 Scroll ke bawah → hide
        if (currentScroll > lastScroll && currentScroll > 50) {
            navbar.style.transform = "translateY(-100%)";
        } 
        // 🔼 Scroll ke atas → show
        else {
            navbar.style.transform = "translateY(0)";
        }

        lastScroll = currentScroll;
    });
});