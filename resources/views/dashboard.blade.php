<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-[#FFF5F0] antialiased text-gray-800" style="font-family: 'Poppins', sans-serif;">

    @include('components.sidebar')
    @include('components.navbar')

    <!-- OVERLAY -->
    <div id="overlay" class="fixed inset-0 bg-black/40 z-40 hidden opacity-0 transition-opacity duration-300">
    </div>

    {{-- Main --}}
    <div class="max-w-6xl mx-auto p-6 mt-4 pt-20">

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
                <a href="{{ route('tryout') }}">
                    <div class="flex justify-center mb-4">
                        <img src="{{ asset('images/BookPencil.png') }}" alt="Bookpencil" class="w-12">
                    </div>
                    <p>Try Out</p>
                </a>
            </div>
            <div>
                <div class="flex justify-center mb-4">
                    <img src="{{ asset('images/Time.png') }}" alt="Time" class="w-12">
                </div>
                <p>Riwayat</p>
            </div>
            <div>
                <div class="flex justify-center mb-4">
                    <img src="{{ asset('images/Rules.png') }}" alt="Rules" class="w-12">
                </div>
                <p>Review</p>
            </div>
            <div>
                <div class="flex justify-center mb-4">
                    <img src="{{ asset('images/Reading.png') }}" alt="Reading" class="w-12">
                </div>
                <p>Materi</p>
            </div>
        </div>

        <!-- Leaderboard -->
        <h2 class="text-center text-xl font-semibold mb-4 mt-15">Leaderboard</h2>

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
    @include('components.footer')
</body>

</html>
