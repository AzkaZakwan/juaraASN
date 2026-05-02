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

    window.addEventListener("scroll", () => {
        const currentScroll = window.scrollY;

        if (currentScroll > lastScroll && currentScroll > 10) {
            navbar.style.top = "-100px";
        } else {
            navbar.style.top = "0";
        }

        lastScroll = currentScroll;
    });
});

const menuBtn = document.getElementById("menuBtn");
const sidebar = document.getElementById("sidebar");
const overlay = document.getElementById("overlay");

if (menuBtn && sidebar && overlay) {
    menuBtn.addEventListener("click", () => {
        sidebar.classList.remove("-translate-x-full");
        overlay.classList.remove("hidden");
        setTimeout(() => overlay.classList.remove("opacity-0"), 10);
    });

    overlay.addEventListener("click", () => {
        sidebar.classList.add("-translate-x-full");
        overlay.classList.add("opacity-0");

        setTimeout(() => overlay.classList.add("hidden"), 300);
    });
}