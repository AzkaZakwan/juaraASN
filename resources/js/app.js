import './bootstrap';
import Swiper from 'swiper';
import 'swiper/css';
import 'swiper/css/pagination';

import { Pagination, Autoplay } from 'swiper/modules';

document.addEventListener('DOMContentLoaded', () => {
    new Swiper('.swiper', {
        modules: [Pagination, Autoplay],
        loop: true,
        autoplay: {
            delay: 3000,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
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