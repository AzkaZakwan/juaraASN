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

document.addEventListener("DOMContentLoaded", () => {

    const leaderboardButtons = document.querySelectorAll(".leaderboard-btn");

    if (leaderboardButtons.length > 0) {

        leaderboardButtons.forEach((button) => {

            button.addEventListener("click", () => {

                leaderboardButtons.forEach((btn) => {

                    btn.classList.remove(
                        "bg-[#FF7A47]",
                        "text-white"
                    );

                    btn.classList.add(
                        "border",
                        "border-[#FF7A47]",
                        "text-[#FF7A47]"
                    );

                });

                button.classList.remove(
                    "border",
                    "border-[#FF7A47]",
                    "text-[#FF7A47]"
                );

                button.classList.add(
                    "bg-[#FF7A47]",
                    "text-white"
                );

            });

        });

    }

});

document.addEventListener("DOMContentLoaded", () => {

    const rankingOverlay = document.getElementById("rankingOverlay");
    const openRanking = document.getElementById("openRanking");
    const closeRanking = document.getElementById("closeRanking");

    if (openRanking && rankingOverlay) {

        openRanking.addEventListener("click", () => {

            rankingOverlay.classList.remove("hidden");

            setTimeout(() => {
                rankingOverlay.classList.remove("opacity-0");
            }, 10);

        });

    }

    if (closeRanking && rankingOverlay) {

        closeRanking.addEventListener("click", () => {

            rankingOverlay.classList.add("opacity-0");

            setTimeout(() => {
                rankingOverlay.classList.add("hidden");
            }, 300);

        });

    }

});

document.addEventListener("DOMContentLoaded", () => {

    const reminderOverlay = document.getElementById("reminderOverlay");
    const openReminder = document.getElementById("openReminder");
    const closeReminder = document.getElementById("closeReminder");

    // OPEN
    if (openReminder && reminderOverlay) {

        openReminder.addEventListener("click", () => {

            reminderOverlay.classList.remove("hidden");

            setTimeout(() => {
                reminderOverlay.classList.remove("opacity-0");
            }, 10);

        });

    }

    // CLOSE
    if (closeReminder && reminderOverlay) {

        closeReminder.addEventListener("click", () => {

            reminderOverlay.classList.add("opacity-0");

            setTimeout(() => {
                reminderOverlay.classList.add("hidden");
            }, 300);

        });

    }

    // CLICK OUTSIDE
    if (reminderOverlay) {

        reminderOverlay.addEventListener("click", (e) => {

            if (e.target === reminderOverlay) {

                reminderOverlay.classList.add("opacity-0");

                setTimeout(() => {
                    reminderOverlay.classList.add("hidden");
                }, 300);

            }

        });

    }

});