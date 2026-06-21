<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persiapan Mengerjakan - raihASN</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="{{ asset('images/juaraASNco.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body class="bg-[#FFF9F5] antialiased text-gray-800"
    style="font-family: 'Poppins', sans-serif;">

    @include('components.sidebar')
    @include('components.navbar')

    <!-- OVERLAY -->
    <div id="overlay"
        class="fixed inset-0 bg-black/40 z-40 hidden opacity-0 transition-opacity duration-300">
    </div>

    <main class="max-w-6xl mx-auto p-6 mt-4 pt-20">

        {{-- BACK --}}
        <button onclick="history.back()" class="hover:scale-110 transition mb-4">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-7 h-7"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15 19l-7-7 7-7" />

            </svg>

        </button>

        <h1 class="text-4xl font-bold text-gray-900 mb-8">
            Persiapan Mengerjakan
        </h1>

        <!-- ALERT -->
        <div
            class="bg-[#FF7A47] text-white p-4 rounded-2xl flex items-center gap-4 shadow-sm mb-8 animate-pulse">

            <div class="bg-white/20 p-2 rounded-full">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />

                </svg>

            </div>

            <p class="font-medium">
                Pastikan tidak ada aktivitas login dari perangkat lain saat try out sedang berjalan
            </p>

        </div>

        <!-- DETAIL TRYOUT -->
        <div class="bg-white border-2 border-[#FF7A47] rounded-3xl p-8 mb-8 shadow-sm">

            <h2 class="text-xl font-bold mb-4">
                {{ $package->name }}
            </h2>

            @if ($package->price == 0)
                <span
                    class="bg-gray-300 text-gray-700 px-4 py-1 rounded-lg text-sm font-semibold">
                    Gratis
                </span>
            @else
                <span
                    class="bg-orange-100 text-[#FF7A47] px-4 py-1 rounded-lg text-sm font-semibold">
                    Premium
                </span>
            @endif

            <div class="mt-6 space-y-3">

                <div class="flex items-center gap-3 text-gray-700 font-medium">

                    <svg class="w-5 h-5"
                        fill="currentColor"
                        viewBox="0 0 20 20">

                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />

                        <path fill-rule="evenodd"
                            d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h.01a1 1 0 100-2H10zm3 0a1 1 0 000 2h.01a1 1 0 100-2H13zM7 13a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h.01a1 1 0 100-2H10zm3 0a1 1 0 000 2h.01a1 1 0 100-2H13z"
                            clip-rule="evenodd" />

                    </svg>

                    <span>
                        Jumlah Soal :
                        <span class="ml-2">
                            {{ $package->questions()->count() }} Soal
                        </span>
                    </span>

                </div>

                <div class="flex items-center gap-3 text-gray-700 font-medium">

                    <svg class="w-5 h-5"
                        fill="currentColor"
                        viewBox="0 0 20 20">

                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                            clip-rule="evenodd" />

                    </svg>

                    <span>
                        Durasi :
                        <span class="ml-10">
                            {{ $package->duration_minutes }} Menit
                        </span>
                    </span>

                </div>

            </div>

        </div>

        <!-- PASSING GRADE -->
        <div class="bg-white border-2 border-[#FF7A47] rounded-3xl p-8 mb-12 shadow-sm">

            <h2 class="text-xl font-bold">
                Passing Grade
            </h2>

            <p class="text-sm text-gray-500 mb-6">
                Standar Kelulusan Minimum
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div
                    class="bg-[#FF7A47] text-white p-6 rounded-2xl text-center shadow-lg hover:scale-105 transition">

                    <p class="text-sm font-bold uppercase tracking-widest">
                        TWK
                    </p>

                    <p class="text-xs mb-4 opacity-80">
                        Tes Wawasan Kebangsaan
                    </p>

                    <p class="text-5xl font-extrabold">
                        65
                    </p>

                </div>

                <div
                    class="bg-[#FF7A47] text-white p-6 rounded-2xl text-center shadow-lg hover:scale-105 transition">

                    <p class="text-sm font-bold uppercase tracking-widest">
                        TIU
                    </p>

                    <p class="text-xs mb-4 opacity-80">
                        Tes Intelegensia Umum
                    </p>

                    <p class="text-5xl font-extrabold">
                        80
                    </p>

                </div>

                <div
                    class="bg-[#FF7A47] text-white p-6 rounded-2xl text-center shadow-lg hover:scale-105 transition">

                    <p class="text-sm font-bold uppercase tracking-widest">
                        TKP
                    </p>

                    <p class="text-xs mb-4 opacity-80">
                        Tes Karakteristik Pribadi
                    </p>

                    <p class="text-5xl font-extrabold">
                        166
                    </p>

                </div>

            </div>

        </div>

        <!-- CTA -->
        <div
            class="bg-[#FF7A47] rounded-[40px] p-10 text-center text-white shadow-xl max-w-2xl mx-auto border border-white/30">

            <h3 class="text-lg font-medium mb-2">
                Sudah Siap?
            </h3>

            <h2 class="text-3xl font-bold mb-8 leading-tight">
                Selamat & Semangat <br>
                Mengerjakan Try Out Kamu!
            </h2>

            <div class="flex flex-col gap-4 max-w-xs mx-auto">

                <button id="openReminder"
                    class="bg-white text-[#FF7A47] font-bold py-3 px-8 rounded-xl shadow-lg hover:scale-105 transition active:scale-95">

                    Mulai Mengerjakan!

                </button>

                <button onclick="history.back()"
                    class="border-2 border-white text-white font-bold py-3 px-8 rounded-xl hover:scale-105 transition active:scale-95">

                    Kembali

                </button>

            </div>

        </div>

        <!-- REMINDER OVERLAY -->
        <div id="reminderOverlay"
            class="fixed inset-0 bg-black/50 z-[70] hidden opacity-0 transition-opacity duration-300">

            <div
                class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 bg-white rounded-3xl shadow-2xl w-[92%] sm:w-[500px] p-8 text-center">

                <h2 class="text-2xl font-bold text-[#FF7A47] mb-6">
                    Reminder
                </h2>

                <div class="flex justify-center mb-6">

                    <div
                        class="w-24 h-24 rounded-full bg-[#FF7A47] flex items-center justify-center shadow-lg">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-12 h-12 text-white"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 9v2m0 4h.01M12 3a9 9 0 100 18 9 9 0 000-18z" />

                        </svg>

                    </div>

                </div>

                <p class="text-gray-600 leading-relaxed mb-8 text-sm sm:text-base">

                    Pastikan tidak ada aktivitas login dari perangkat lain
                    saat try out akan dilakukan.

                </p>

                <div class="flex flex-col gap-3">

                    <form action="{{ route('tryout.start', $package->id) }}"
                        method="POST">

                        @csrf

                        <button type="submit"
                            class="w-full bg-[#FF7A47] hover:bg-[#f06b38] text-white font-semibold py-3 rounded-xl shadow-lg transition">

                            Mulai Mengerjakan

                        </button>

                    </form>

                    <button id="closeReminder"
                        class="border border-gray-300 text-gray-600 py-3 rounded-xl hover:bg-gray-100 transition">

                        Batal

                    </button>

                </div>

            </div>

        </div>

    </main>

</body>

</html>

