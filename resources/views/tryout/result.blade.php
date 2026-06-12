<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Try Out - raihASN</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body class="bg-[#FFF9F5] antialiased text-gray-800" style="font-family: 'Poppins', sans-serif;">

    @include('components.sidebar')
    @include('components.navbar')

    <div id="overlay"
        class="fixed inset-0 bg-black/40 z-40 hidden opacity-0 transition-opacity duration-300">
    </div>

    <main class="max-w-6xl mx-auto p-6 mt-4 pt-20">

        <a href="{{ route('dashboard') }}" class="inline-block hover:scale-110 transition mb-4">
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
        </a>

        <h1 class="text-4xl font-bold text-gray-900 mb-8">
            Hasil Try Out
        </h1>

        @php
            $total = $attempt->score_twk + $attempt->score_tiu + $attempt->score_tkp;

            $lulusTwk = $attempt->score_twk >= 65;
            $lulusTiu = $attempt->score_tiu >= 80;
            $lulusTkp = $attempt->score_tkp >= 166;

            $lulus = $lulusTwk && $lulusTiu && $lulusTkp;
        @endphp

        <div
            class="{{ $lulus ? 'bg-green-500' : 'bg-red-500' }} text-white p-4 rounded-2xl flex items-center gap-4 shadow-sm mb-8">

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
                {{ $lulus ? 'Selamat! Kamu memenuhi passing grade.' : 'Tetap semangat! Nilai kamu belum memenuhi passing grade.' }}
            </p>
        </div>

        <div class="bg-white border-2 border-[#FF7A47] rounded-3xl p-8 mb-8 shadow-sm">

            <h2 class="text-xl font-bold mb-4">
                {{ $attempt->package->name }}
            </h2>

            <span class="bg-orange-100 text-[#FF7A47] px-4 py-1 rounded-lg text-sm font-semibold">
                Selesai
            </span>

            <div class="mt-6 space-y-3">

                <div class="flex items-center gap-3 text-gray-700 font-medium">
                    <span>Waktu Selesai :</span>
                    <span class="ml-2">
                        {{ $attempt->finished_at ? $attempt->finished_at->format('d M Y H:i') : '-' }}
                    </span>
                </div>

                <div class="flex items-center gap-3 text-gray-700 font-medium">
                    <span>Total Nilai :</span>
                    <span class="ml-8 font-bold text-[#FF7A47]">
                        {{ $total }}
                    </span>
                </div>

            </div>

        </div>

        <div class="bg-white border-2 border-[#FF7A47] rounded-3xl p-8 mb-12 shadow-sm">

            <h2 class="text-xl font-bold">
                Rincian Nilai
            </h2>

            <p class="text-sm text-gray-500 mb-6">
                Perbandingan nilai dengan passing grade
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="{{ $lulusTwk ? 'bg-[#FF7A47]' : 'bg-red-500' }} text-white p-6 rounded-2xl text-center shadow-lg hover:scale-105 transition">
                    <p class="text-sm font-bold uppercase tracking-widest">TWK</p>
                    <p class="text-xs mb-4 opacity-80">Passing Grade 65</p>
                    <p class="text-5xl font-extrabold">{{ $attempt->score_twk }}</p>
                    <p class="text-xs mt-2 opacity-80">Maksimal 150</p>
                    <p class="mt-3 text-sm font-bold">
                        {{ $lulusTwk ? 'Lulus' : 'Tidak Lulus' }}
                    </p>
                </div>

                <div class="{{ $lulusTiu ? 'bg-[#FF7A47]' : 'bg-red-500' }} text-white p-6 rounded-2xl text-center shadow-lg hover:scale-105 transition">
                    <p class="text-sm font-bold uppercase tracking-widest">TIU</p>
                    <p class="text-xs mb-4 opacity-80">Passing Grade 80</p>
                    <p class="text-5xl font-extrabold">{{ $attempt->score_tiu }}</p>
                    <p class="text-xs mt-2 opacity-80">Maksimal 175</p>
                    <p class="mt-3 text-sm font-bold">
                        {{ $lulusTiu ? 'Lulus' : 'Tidak Lulus' }}
                    </p>    
                </div>

                <div class="{{ $lulusTkp ? 'bg-[#FF7A47]' : 'bg-red-500' }} text-white p-6 rounded-2xl text-center shadow-lg hover:scale-105 transition">
                    <p class="text-sm font-bold uppercase tracking-widest">TKP</p>
                    <p class="text-xs mb-4 opacity-80">Passing Grade 166</p>
                    <p class="text-5xl font-extrabold">{{ $attempt->score_tkp }}</p>
                    <p class="text-xs mt-2 opacity-80">Maksimal 225</p>
                    <p class="mt-3 text-sm font-bold">
                        {{ $lulusTkp ? 'Lulus' : 'Tidak Lulus' }}
                    </p>
                </div>

            </div>

        </div>

        <div
            class="bg-[#FF7A47] rounded-[40px] p-10 text-center text-white shadow-xl max-w-2xl mx-auto border border-white/30">

            <h3 class="text-lg font-medium mb-2">
                Total Nilai Kamu
            </h3>

            <h2 class="text-6xl font-bold mb-8 leading-tight">
                {{ $total }}
            </h2>

            <div class="flex flex-col gap-4 max-w-xs mx-auto">

                @if($attempt->package->show_explanation)
                    <a href="{{ route('tryout.review', $attempt->id) }}"
                        class="bg-white text-[#FF7A47] font-bold py-3 px-8 rounded-xl shadow-lg hover:scale-105 transition active:scale-95">
                        Review Pembahasan
                    </a>
                @endif
                {{-- <a href="{{ route('tryout') }}"
                    class="bg-white text-[#FF7A47] font-bold py-3 px-8 rounded-xl shadow-lg hover:scale-105 transition active:scale-95">
                    Kerjakan Ulang Try Out
                </a> --}}
                <a href="{{ route('dashboard') }}"
                    class="border-2 border-white text-white font-bold py-3 px-8 rounded-xl hover:scale-105 transition active:scale-95">
                    Kembali ke Dashboard
                </a>

            </div>

        </div>

    </main>

</body>

</html>