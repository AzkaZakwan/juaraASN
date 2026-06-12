<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coming Soon</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body class="bg-[#F8F4F1]" style="font-family: 'Poppins', sans-serif;">

    @include('components.sidebar')
    @include('components.navbar')

    <!-- OVERLAY -->
    <div id="overlay" class="fixed inset-0 bg-black/40 z-40 hidden opacity-0 transition-opacity duration-300">
    </div>

    {{-- MAIN --}}
    <main class="min-h-screen flex items-center justify-center px-6 pt-20">

        <div class="text-center">

            {{-- ICON --}}
            <div
                class="w-28 h-28 mx-auto mb-8 rounded-full bg-[#FFE5DA] flex items-center justify-center animate-pulse">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-14 h-14 text-[#FF7A47]" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M3 15a4 4 0 014-4h.879a3 3 0 005.242 0H17a4 4 0 110 8H7a4 4 0 01-4-4Z" />

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M12 3v9m0 0l-3-3m3 3l3-3" />

                </svg>

            </div>

            {{-- TITLE --}}
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-gray-900 tracking-tight mb-4">

                COMING SOON

            </h1>

            {{-- SUBTITLE --}}
            <p class="text-gray-500 text-sm sm:text-base md:text-lg max-w-xl mx-auto leading-relaxed">

                Fitur ini sedang dalam tahap pengembangan dan akan segera hadir
                dengan pengalaman yang lebih menarik dan modern untuk kamu 😉

            </p>

            {{-- BUTTON --}}
            <div class="mt-10">

                <a href="javascript:history.back()"
                    class="inline-flex items-center gap-2 bg-[#FF7A47] hover:bg-[#f06a37] text-white font-semibold px-8 py-3 rounded-2xl shadow-lg hover:scale-105 transition">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />

                    </svg>

                    Kembali

                </a>

            </div>

        </div>

    </main>

</body>

</html>
