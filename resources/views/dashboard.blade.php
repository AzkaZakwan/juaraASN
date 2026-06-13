<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="icon" type="image/png" href="{{ asset('images/juaraASNco.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-[#FFF9F5] antialiased text-gray-800" style="font-family: 'Poppins', sans-serif;">

    @include('components.sidebar')
    @include('components.navbar')

    <!-- OVERLAY -->
    <div id="overlay" class="fixed inset-0 bg-black/40 z-40 hidden opacity-0 transition-opacity duration-300">
    </div>

    <!-- MAIN -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-24 lg:pt-28 pb-10">

        <!-- WELCOME -->
        <div class="mb-6 text-center lg:text-left">

            <h2 class="text-xl sm:text-2xl font-bold text-gray-700">
                Selamat Datang Kembali
            </h2>

            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold mt-2">
                {{ Auth::user()->name }}
            </h1>

        </div>

        <!-- BANNER -->
        <!-- BANNER -->
        <div class="swiper rounded-2xl overflow-hidden mb-8 shadow-lg bg-white">

            <div class="swiper-wrapper">

                <div class="swiper-slide">
                    <div class="relative w-full aspect-[1224/303]">
                        <img src="{{ asset('images/banner1.png') }}" alt="Banner 1"
                            class="w-full h-full object-contain">
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="relative w-full aspect-[1224/303]">
                        <img src="{{ asset('images/banner2.png') }}" alt="Banner 2"
                            class="w-full h-full object-contain">
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="relative w-full aspect-[1224/303]">
                        <img src="{{ asset('images/banner3.png') }}" alt="Banner 3"
                            class="w-full h-full object-contain">
                    </div>
                </div>

            </div>

            <div class="swiper-pagination"></div>

        </div>

        <!-- MENU -->
        <div class="flex justify-center mb-10">

            <div
                class="bg-[#FFA35C] rounded-3xl shadow-xl px-6 py-6 grid grid-cols-3 gap-6 w-full max-w-3xl text-white">

                <!-- TRY OUT -->
                <a href="{{ route('tryout') }}"
                    class="flex flex-col items-center justify-center hover:scale-105 transition">

                    <div class="flex justify-center mb-3">
                        <img src="{{ asset('images/BookPencil.png') }}" alt="BookPencil" class="w-8 sm:w-12">
                    </div>

                    <p class="text-sm sm:text-base font-medium text-center">
                        Try Out
                    </p>
                </a>

                <!-- RIWAYAT -->
                <a href="{{ route('riwayat') }}"
                    class="flex flex-col items-center justify-center hover:scale-105 transition">

                    <div class="flex justify-center mb-3">
                        <img src="{{ asset('images/Time.png') }}" alt="Time" class="w-8 sm:w-12">
                    </div>

                    <p class="text-sm sm:text-base font-medium text-center">
                        Riwayat
                    </p>
                </a>

                <!-- MATERI -->
                <a href="{{ route('materi') }}"
                    class="flex flex-col items-center justify-center hover:scale-105 transition">

                    <div class="flex justify-center mb-3">
                        <img src="{{ asset('images/Reading.png') }}" alt="Reading" class="w-8 sm:w-12">
                    </div>

                    <p class="text-sm sm:text-base font-medium text-center">
                        Materi
                    </p>
                </a>

            </div>

        </div>

        @php
            $totalPackages = Auth::user()->packages()->count();

            $ownedPackages = Auth::user()->packages()->latest('user_packages.created_at')->take(2)->get();
        @endphp

        <!-- PAKET SAYA -->
        <div class="mb-12">

            @if ($ownedPackages->count() > 0)

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">

                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800">
                                Paket Saya
                            </h3>

                            <p class="text-gray-500 text-sm mt-1">
                                Paket yang sudah kamu miliki.
                            </p>
                        </div>

                        <span class="bg-[#FFA35C]/20 text-[#FFA35C] px-4 py-2 rounded-xl font-semibold text-sm">
                            {{ $totalPackages }} Paket
                        </span>
                    </div>

                    <div class="grid gap-4">

                        @foreach ($ownedPackages as $package)
                            <div
                                class="border rounded-2xl p-5 flex justify-between items-center hover:shadow-md transition">

                                <div>
                                    <h4 class="font-bold text-lg">
                                        {{ $package->name }}
                                    </h4>

                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ $package->questions->count() }} Soal •
                                        {{ $package->duration_minutes }} Menit
                                    </p>
                                </div>

                                <a href="{{ route('prepare', $package->id) }}"
                                    class="bg-[#FFA35C] text-white px-5 py-2 rounded-xl font-semibold hover:scale-105 transition">
                                    Kerjakan
                                </a>

                            </div>
                        @endforeach

                        @if ($totalPackages > 3)
                            <div class="text-center pt-2">
                                <a href="{{ route('tryout') }}" class="text-[#FFA35C] font-semibold hover:underline">
                                    Lihat Semua Paket →
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-10 text-center">

                    <div
                        class="w-20 h-20 mx-auto mb-5 rounded-full bg-[#FFF2E8] flex items-center justify-center text-4xl">
                        📚
                    </div>

                    <h3 class="text-2xl font-bold text-gray-800">
                        Belum Ada Paket
                    </h3>

                    <p class="text-gray-500 mt-3 max-w-md mx-auto">
                        Kamu belum memiliki paket try out.
                    </p>

                    <a href="{{ route('tryout') }}"
                        class="inline-flex items-center mt-6 bg-[#FFA35C] text-white px-6 py-3 rounded-xl font-semibold hover:shadow-lg hover:scale-105 transition">
                        Lihat Paket Try Out
                    </a>

                </div>

            @endif

        </div>
    </main>
    @include('components.footer')
</body>

</html>
