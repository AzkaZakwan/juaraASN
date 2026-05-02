<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-[#FFF5F0] antialiased text-gray-800" style="font-family: 'Poppins', sans-serif;">

      <nav id="navbar"
        class="fixed top-0 left-0 w-full z-50 bg-[#FF7A47] px-4 sm:px-6 py-3 flex justify-between items-center text-white shadow-md transition-transform duration-300">
        <div class="flex items-center gap-4">
            <button id="menuBtn" class="text-white text-2xl cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>

            <div class="flex items-center gap-6 text-2xl font-bold tracking-wider">LOGO</div>
        </div>

        <div class="hidden md:flex items-center gap-6">
            <span class="font-semibold cursor-pointer">raihASN</span>

            <div class="relative cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
            </div>

            <img src="https://ui-avatars.com/api/?name=User&background=0D8ABC&color=fff"
                class="w-10 h-10 rounded-full border-2 border-white" alt="Profile">
        </div>
    </nav>

    <!-- OVERLAY -->
    <div id="overlay" class="fixed inset-0 bg-black/40 z-40 hidden opacity-0 transition-opacity duration-300">
    </div>

    <!-- SIDEBAR -->
    <div id="sidebar"
        class="fixed top-0 left-0 w-64 sm:w-72 h-full bg-white z-50 transform -translate-x-full transition-transform duration-300 shadow-lg ">

        <!-- Header -->
        <div class="bg-[#FF7A47] text-white px-6 py-5.5 font-bold text-lg">
            LOGO
        </div>

        <!-- Menu -->
        <div class="p-5 space-y-6 text-gray-700">

            <a href="{{ route('dashboard') }}" class="flex gap-2  hover:text-orange-500 cursor-pointer mb-5 mt-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                <span>Beranda</span>
            </a>

            <div>
                <p class="text-sm font-bold mb-6">PROGRAM BELAJAR</p>
                <ul class="space-y-4">
                    <a href="{{ route('tryout') }}" class="flex gap-2 hover:text-orange-500 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                        </svg>
                        <span>Try Out</span>
                    </a>
                    <li class="flex gap-2 hover:text-orange-500 cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                        </svg>
                        <span>Materi</span>
                    </li>
                </ul>
            </div>

            <div>
                <p class="text-sm font-bold mb-6">PEMBELIAN</p>
                <ul class="space-y-4">
                    <li class="flex gap-2 hover:text-orange-500 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                        </svg>
                        <span>Beli Paket</span>
                    </li>
                    <li class="flex gap-2 hover:text-orange-500 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                        <span>Keranjang</span>
                    </li>
                    <li class="flex gap-2 hover:text-orange-500 cursor-pointer"> <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                        </svg>
                        <span>Pembayaran</span>
                    </li>
                </ul>
            </div>

            <div class=" mt-10 flex gap-2 hover:text-orange-500 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                </svg>
                <span>Tentang Kami</span>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto mt-6 px-4 pt-20">

        <!-- Welcome -->
        <h2 class=" text-2xl font-bold mb-6">Selamat Datang Kembali</h2>
        <h1 class="text-5xl font-bold mb-6">Mustafa</h1>

        <!-- Banner -->
        <div class="swiper rounded-xl overflow-hidden mb-6">

            <div class="swiper-wrapper">

                <!-- Slide -->
                <div class="swiper-slide">
                    <div class="relative w-full aspect-[16/4]">
                        <img src="https://picsum.photos/1200/500?1" class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Slide -->
                <div class="swiper-slide">
                    <div class="w-full aspect-[16/4]">
                        <img src="https://picsum.photos/1200/500?2" class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Slide -->
                <div class="swiper-slide">
                    <div class="w-full aspect-[16/4]">
                        <img src="https://picsum.photos/1200/500?3" class="w-full h-full object-cover">
                    </div>
                </div>

            </div>

            <div class="swiper-pagination"></div>
        </div>


        <!-- Menu -->
        <div
            class="bg-[#FF7A47] rounded-xl shadow-lg p-8 grid grid-cols-4 text-center text-white mb-8 max-w-5xl mx-auto">
            <div>
                <a href="/tryout">
                    <div class="text-3xl">📘</div>
                    <p>Try Out</p>
                </a>

            </div>
            <div>
                <div class="text-3xl">⏱️</div>
                <p>Riwayat</p>
            </div>
            <div>
                <div class="text-3xl">📋</div>
                <p>Review</p>
            </div>
            <div>
                <div class="text-3xl">📚</div>
                <p>Materi</p>
            </div>
        </div>

        <!-- Leaderboard -->
        <h2 class="text-center text-xl font-semibold mb-4">Leaderboard</h2>

        <!-- Filter Tabs -->
        <div class="flex justify-center gap-3 mb-4">
            <button class="bg-[#FF7A47] text-white px-4 py-1 rounded-full">Harian</button>
            <button class="border border-[#FF7A47] text-[#FF7A47] px-4 py-1 rounded-full">Mingguan</button>
            <button class="border border-[#FF7A47] text-[#FF7A47] px-4 py-1 rounded-full">Bulanan</button>
        </div>

        <!-- List -->
        <div class="space-y-3 mb-12 max-w-6xl mx-auto">

            <!-- Item -->
            <div class="bg-white rounded-xl shadow p-4 flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <span class="font-bold">1</span>
                    <div>
                        <p class="font-semibold">Nama User</p>
                        <p class="text-sm text-gray-500">Alamat - Detail User</p>
                    </div>
                </div>
                <button class="bg-[#FF7A47] text-white px-4 py-1 rounded-lg text-sm">
                    Detail
                </button>
            </div>

            <div class="bg-white rounded-xl shadow p-4 flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <span class="font-bold">2</span>
                    <div>
                        <p class="font-semibold">Nama User</p>
                        <p class="text-sm text-gray-500">Alamat - Detail User</p>
                    </div>
                </div>
                <button class="bg-[#FF7A47] text-white px-4 py-1 rounded-lg text-sm">
                    Detail
                </button>
            </div>
        </div>
    </div>

    <!-- PAKET BELAJAR -->

    <section class="border border-[#FF7A47] rounded-2xl p-8 mb-12 max-w-4xl mx-auto">
        <h2 class="text-center text-lg font-semibold mb-8">Paket Belajar</h2>

        <div class="grid md:grid-cols-2 gap-10 max-w-3xl mx-auto">

            <!-- Guest -->
            <div class="bg-[#FF7A47] rounded-xl p-3 shadow-md">
                <div class="bg-white rounded-lg p-4">
                    <h3>Guest</h3>
                    <p class="text-3xl font-bold">Rp 0</p>
                    <button class="mt-3 bg-[#FF7A47] text-white text-xs px-5 py-1 rounded-full">
                        Purchase
                    </button>
                </div>

                <ul class="text-white mt-4 text-sm space-y-1 list-disc list-inside">
                    <li>a</li>
                    <li>b</li>
                    <li>c</li>
                    <li>d</li>
                    <li>e</li>
                    <li>f</li>
                </ul>
            </div>

            <!-- Premium -->
            <div class="bg-[#FF7A47] rounded-xl p-3 shadow-md">
                <div class="bg-white rounded-lg p-4">
                    <h3>Premium</h3>
                    <p class="text-3xl font-bold">Rp 90.000</p>
                    <button class="mt-3 bg-[#FF7A47] text-white text-xs px-5 py-1 rounded-full">
                        Purchase
                    </button>
                </div>

                <ul class="text-white mt-4 text-sm space-y-1 list-disc list-inside">
                    <li>a</li>
                    <li>b</li>
                    <li>c</li>
                    <li>d</li>
                    <li>e</li>
                    <li>f</li>
                </ul>
            </div>

        </div>
    </section>

    <!-- ARTIKEL -->
    <section class="mb-12 max-w-4xl mx-auto">
        <h2 class="text-center text-lg font-semibold mb-6">Artikel</h2>

        <div class="space-y-4 max-h-[505px] overflow-y-auto pr-2 pb-4">
            @for ($i = 1; $i <= 5; $i++)
                <div class="bg-white border rounded-xl p-4 flex gap-4 shadow-sm">
                    <div class="w-20 h-20 bg-gray-200 rounded-md"></div>
                    <div>
                        <p class="text-xs text-gray-500">Tanggal</p>
                        <h3 class="font-semibold">Judul Artikel</h3>
                        <p class="text-sm text-gray-600">Isi Artikel</p>
                    </div>
                </div>
            @endfor
        </div>
    </section>

    </div>

    <!-- Footer -->
    <footer class="bg-[#FF7A47] h-24"></footer>
</body>

</html>
