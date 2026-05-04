<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-[#FFF5F0] antialiased text-gray-800" style="font-family: 'Poppins', sans-serif; scroll-smooth">

    <!-- NAVBAR -->
    <nav id="navbar"
        class="fixed top-0 left-0 w-full z-50 
           bg-[#FF7A47]/90 backdrop-blur-md text-white 
           shadow-md transition-all duration-300 will-change-transform">

        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 
                flex justify-between items-center py-4 transition-all duration-300">

            <!-- LOGO -->
            <div>
                <img src="{{ asset('images/logoraih.png') }}" alt="logo" class="h-12 transition-all duration-300">
            </div>

            <!-- MENU -->
            <div class="hidden md:flex gap-6 items-center text-lg">

                <a href="#" class="hover:text-orange-300 transition">
                    Paket
                </a>

                <a href="#" class="hover:text-orange-300 transition">
                    Testimoni
                </a>

                <a href="#" class="hover:text-orange-300 transition">
                    Blog
                </a>

                <a href="#" class="hover:text-orange-300 transition">
                    Tentang Kami
                </a>

                <!-- BUTTON -->
                <a href="{{ route('login') }}"
                    class="inline-block bg-blue-500 px-4 py-2 rounded-xl text-white
                       transition duration-300
                       hover:bg-blue-600 hover:shadow-lg hover:scale-105 active:scale-95">
                    Log in
                </a>

            </div>
        </div>
    </nav>
    <!-- HERO -->
    <section class="max-w-7xl mx-auto px-6 py-32 grid md:grid-cols-2 items-center gap-10">

        <!-- LEFT -->
        <div>
            <h1 class="text-5xl md:text-6xl font-bold leading-tight mb-6">
                Bantu Kamu <br>
                Lulus & Raih <br>
                <span class="text-[#FF7A47]">ASN!</span>
            </h1>

            <p class="text-gray-600 mb-6 text-lg">
                Latihan soal, try out dan bimbingan online untuk persiapan seleksi.
                Ketahui kemampuanmu dan tingkatkan skor secara bertahap.
            </p>

            <a href="{{ route('login') }}"
                class="inline-block bg-blue-500 text-white px-6 py-3 rounded-xl shadow hover:bg-blue-600 hover:shadow-lg hover:scale-105 transition">
                Mulai Try Out
            </a>
        </div>

        <!-- RIGHT IMAGE -->
        <div class="flex justify-center">
            <img src="{{ asset('images/Vector.png') }}" class="w-[350px] md:w-[450px]">
        </div>
    </section>

    <!-- ABOUT -->
    <section class="max-w-7xl mx-auto px-6 py-16 grid md:grid-cols-2 items-center gap-10">

        <!-- IMAGE -->
        <div class="flex justify-center relative">
            <div class="absolute w-64 h-64 bg-orange-500 rounded-full -z-10"></div>
            <img src="{{ asset('images/belajar.png') }}" class="w-[300px]">
        </div>

        <!-- TEXT -->
        <div>
            <h2 class="text-5xl font-bold mb-4">RaihASN</h2>

            <p class="text-gray-600 mb-4 text-lg text-justify">
                Kami adalah platform try out ASN yang hadir untuk membantu para pejuang
                aparatur sipil negara mempersiapkan diri secara lebih efektif, terarah,
                dan percaya diri.
            </p>

            <p class="text-gray-600 mb-4 text-lg text-justify">
                Kami memahami bahwa persaingan dalam seleksi ASN semakin ketat,
                sehingga dibutuhkan latihan yang tidak hanya banyak, tetapi juga
                berkualitas dan relevan dengan standar terbaru.
            </p>

            <p class="text-gray-600 text-lg text-justify">
                Kami percaya bahwa setiap orang memiliki peluang yang sama untuk berhasil,
                selama didukung dengan persiapan yang tepat.
            </p>
        </div>
    </section>

    <!-- FITUR -->
    <section class="relative py-20 px-6 bg-[#FFF5F0]">
        <div class="max-w-6xl mx-auto grid md:grid-cols-3 gap-8 text-center">

            <!-- CARD 1 -->
            <div class="bg-[#FF7A47] text-white p-10 rounded-2xl shadow-lg hover:scale-105 transition">
                <div class="flex justify-center text-5xl mb-4">
                    <img src="{{ asset('images/BookPencil.png') }}" alt="Bookpencil">
                </div>
                <h3 class="text-2xl font-semibold mb-2">Try Out</h3>
                <p class="text-sm opacity-80">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vero,
                    animi
                    consectetur. Eius, provident! Reiciendis facilis assumenda dicta corrupti magnam sit aut
                    eos.
                    Commodi reiciendis voluptatem deleniti, beatae aliquid temporibus. Provident?</p>
            </div>

            <!-- CARD 2 -->
            <div class="bg-[#FF7A47] text-white p-10 rounded-2xl shadow-lg hover:scale-105 transition">
                <div class="flex justify-center text-5xl mb-4">
                    <img src="{{ asset('images/Reading.png') }}" alt="Reading">
                </div>
                <h3 class="text-xl font-semibold mb-2">Materi</h3>
                <p class="text-sm opacity-80">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam
                    dolorem
                    sint nisi, doloribus accusantium officia repudiandae repellendus est qui deserunt laudantium
                    illum
                    amet non officiis omnis, minima voluptates voluptas quasi?</p>
            </div>

            <!-- CARD 3 -->
            <div class="bg-[#FF7A47] text-white p-10 rounded-2xl shadow-lg hover:scale-105 transition">
                <div class="flex justify-center text-5xl mb-4">
                    <img src="{{ asset('images/Rules.png') }}" alt="Rules">
                </div>
                <h3 class="text-xl font-semibold mb-2">Review</h3>
                <p class="text-sm opacity-80">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quam sed
                    modi
                    veritatis esse maiores doloribus similique. Vero, possimus ullam dolor omnis quae, repellat
                    corporis, fuga asperiores eius numquam sunt rem.</p>
            </div>

        </div>
    </section>

    <!-- TESTIMONI -->
    <section class="py-20 px-6 bg-[#FFF5F0]">

        <div class="max-w-6xl mx-auto text-center mb-10">
            <h2 class="text-3xl font-bold mb-2">Apa Kata Mereka?</h2>
            <p class="text-gray-500">Banyak yang sudah berhasil, ini kata mereka</p>
        </div>

        <div class="grid md:grid-cols-3 gap-6 max-w-6xl mx-auto">

            <!-- TESTI CARD -->
            <div class="border border-orange-300 rounded-xl p-5 bg-white shadow-sm">
                <p class="text-sm text-gray-600 mb-4">
                    Corem ipsum dolor sit amet, consectetur adipiscing elit.
                    Etiam eu turpis molestie, dictum est a, mattis tellus.
                </p>

                <div class="flex items-center gap-3">
                    <img src="https://i.pravatar.cc/40" class="w-10 h-10 rounded-full">
                    <div>
                        <p class="font-semibold text-sm">Nama User</p>
                        <p class="text-xs text-gray-400">Lulus CPNS 2025</p>
                    </div>
                </div>
            </div>

            <!-- DUPLICATE -->
            <div class="border border-orange-300 rounded-xl p-5 bg-white shadow-sm">
                <p class="text-sm text-gray-600 mb-4">
                    Corem ipsum dolor sit amet, consectetur adipiscing elit.
                    Etiam eu turpis molestie, dictum est a, mattis tellus.
                </p>

                <div class="flex items-center gap-3">
                    <img src="https://i.pravatar.cc/41" class="w-10 h-10 rounded-full">
                    <div>
                        <p class="font-semibold text-sm">Nama User</p>
                        <p class="text-xs text-gray-400">Lulus PPPK</p>
                    </div>
                </div>
            </div>

            <div class="border border-orange-300 rounded-xl p-5 bg-white shadow-sm">
                <p class="text-sm text-gray-600 mb-4">
                    Corem ipsum dolor sit amet, consectetur adipiscing elit.
                    Etiam eu turpis molestie, dictum est a, mattis tellus.
                </p>

                <div class="flex items-center gap-3">
                    <img src="https://i.pravatar.cc/42" class="w-10 h-10 rounded-full">
                    <div>
                        <p class="font-semibold text-sm">Nama User</p>
                        <p class="text-xs text-gray-400">Top Score Nasional</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- ROW 2 -->
        <div class="grid md:grid-cols-3 gap-6 max-w-6xl mx-auto mt-6">

            <div class="border border-orange-300 rounded-xl p-5 bg-white shadow-sm">
                <p class="text-sm text-gray-600 mb-4">
                    Corem ipsum dolor sit amet, consectetur adipiscing elit.
                </p>

                <div class="flex items-center gap-3">
                    <img src="https://i.pravatar.cc/43" class="w-10 h-10 rounded-full">
                    <div>
                        <p class="font-semibold text-sm">Nama User</p>
                        <p class="text-xs text-gray-400">Lulus CPNS</p>
                    </div>
                </div>
            </div>

            <div class="border border-orange-300 rounded-xl p-5 bg-white shadow-sm">
                <p class="text-sm text-gray-600 mb-4">
                    Corem ipsum dolor sit amet, consectetur adipiscing elit.
                </p>

                <div class="flex items-center gap-3">
                    <img src="https://i.pravatar.cc/44" class="w-10 h-10 rounded-full">
                    <div>
                        <p class="font-semibold text-sm">Nama User</p>
                        <p class="text-xs text-gray-400">Peserta Terbaik</p>
                    </div>
                </div>
            </div>

            <div class="border border-orange-300 rounded-xl p-5 bg-white shadow-sm">
                <p class="text-sm text-gray-600 mb-4">
                    Corem ipsum dolor sit amet, consectetur adipiscing elit.
                </p>

                <div class="flex items-center gap-3">
                    <img src="https://i.pravatar.cc/45" class="w-10 h-10 rounded-full">
                    <div>
                        <p class="font-semibold text-sm">Nama User</p>
                        <p class="text-xs text-gray-400">Lulus Seleksi</p>
                    </div>
                </div>
            </div>

        </div>

    </section>
    <!-- PAKET BELAJAR -->

    <section class="rounded-2xl p-8 mb-12 max-w-4xl mx-auto">
        <div class="max-w-6xl mx-auto text-center mb-10">
            <h2 class="text-3xl font-bold mb-2">Paket</h2>
        </div>

        <div class="grid md:grid-cols-2 gap-10 max-w-3xl mx-auto">

            <!-- Guest -->
            <div class="bg-[#FF7A47] rounded-xl p-3 shadow-md bg-gradient-to-b from-[#FF7A47] to-[#FF8B60]">
                <div class="bg-white rounded-lg p-4">
                    <h3>Gratis</h3>
                    <p class="text-3xl font-bold">Rp 0</p>
                    <button class="mt-3 bg-[#FF7A47] text-white text-xs px-5 py-1 rounded-full">
                        Coba Sekarang
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
            <div class="bg-[#FF7A47] rounded-xl p-3 shadow-md bg-gradient-to-b from-[#FF7A47] to-[#FF8B60]">
                <div class="bg-white rounded-lg p-4">
                    <h3>Premium</h3>
                    <p class="text-3xl font-bold">Rp 90.000</p>
                    <button class="mt-3 bg-[#FF7A47] text-white text-xs px-5 py-1 rounded-full">
                        Coba Sekarang
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
    <section class="mb-1 max-w-4xl mx-auto">
        <div class="max-w-6xl mx-auto text-center mb-10">
            <h2 class="text-3xl font-bold mb-2">Artikel</h2>
        </div>

        <div class="space-y-4 max-h-[510px] overflow-y-auto pr-2 pb-4">
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

    <!-- CTA SECTION -->
    <section class="bg-[#FFF5F0] py-16 px-6">
        <div
            class="max-w-5xl mx-auto bg-gradient-to-b from-[#FF7A47] to-[#FFB199] text-white rounded-3xl text-center py-12 px-6 shadow-lg">
            <h2 class="text-xl md:text-2xl font-semibold mb-6">
                Mulai hari ini, <BR>selangkah lebih dekat jadi ASN</BR>
            </h2>

            <a href="/tryout"
                class="inline-block bg-white text-[#FF7A47] font-semibold px-6 py-3 rounded-xl shadow hover:scale-105 hover:bg-orange-100 transition">
                Mulai Belajar
            </a>
        </div>
    </section>
    @include('components.footer')
</body>

</html>
