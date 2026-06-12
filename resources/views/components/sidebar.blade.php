<!-- SIDEBAR -->
<div id="sidebar"
    class="fixed top-[80px] left-0 w-64 sm:w-72 h-[calc(100vh-80px)] bg-white z-50 transform -translate-x-full transition-transform duration-300 shadow-lg overflow-y-auto">

    <div class="p-5 space-y-6 text-gray-700">

        <!-- BERANDA -->
        <a href="{{ route('dashboard') }}"
            class="flex items-center gap-3 hover:text-orange-500 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 0 0 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            <span>Beranda</span>
        </a>

        <!-- PROGRAM BELAJAR -->
        <div>
            <p class="text-sm font-bold mb-4 text-gray-500">
                PROGRAM BELAJAR
            </p>

            <ul class="space-y-4">

                <li>
                    <a href="{{ route('tryout') }}"
                        class="flex items-center gap-3 hover:text-orange-500 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                        </svg>
                        <span>Try Out</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('riwayat') }}"
                        class="flex items-center gap-3 hover:text-orange-500 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v6l4 2m6-2a10 10 0 1 1-20 0 10 10 0 0 1 20 0Z" />
                        </svg>
                        <span>Riwayat</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('materi') }}"
                        class="flex items-center gap-3 hover:text-orange-500 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25A8.966 8.966 0 0 1 18 3.75c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                        </svg>
                        <span>Materi</span>
                    </a>
                </li>

            </ul>
        </div>

    </div>
</div>