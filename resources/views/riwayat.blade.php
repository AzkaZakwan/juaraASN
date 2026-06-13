<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soal Anda</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="{{ asset('images/juaraASNco.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-[#F8F4F1] text-gray-800" style="font-family: 'Poppins', sans-serif;">

    @include('components.sidebar')
    @include('components.navbar')

    <!-- OVERLAY -->
    <div id="overlay" class="fixed inset-0 bg-black/40 z-40 hidden opacity-0 transition-opacity duration-300">
    </div>

    {{-- MAIN --}}
    <main class="max-w-6xl mx-auto px-4 sm:px-6 pt-24 pb-10">

        {{-- BACK --}}
        <a href="{{ route('dashboard') }}" class="inline-block hover:scale-110 transition">

            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">

                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />

            </svg>

        </a>

        {{-- TITLE --}}
        <h1 class="text-3xl font-bold mb-8">
            Soal Anda
        </h1>

        {{-- SEARCH --}}
        <div class="flex flex-col sm:flex-row gap-3 mb-8">

            {{-- INPUT --}}
            <div class="relative flex-1">

                <input type="text" id="searchInput" placeholder="Cari Riwayat...."
                    class="w-full bg-white border border-gray-200 rounded-xl pl-12 pr-4 py-3 outline-none focus:ring-2 focus:ring-orange-300">

                {{-- ICON --}}
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-gray-400" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m21 21-4.35-4.35m1.85-5.65a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z" />

                </svg>

            </div>

            {{-- FILTER --}}
            {{-- <button
                class="bg-[#8CB2FF] px-5 py-3 rounded-xl flex items-center justify-center gap-2 hover:scale-105 transition">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 4a1 1 0 011-1h16a1 1 0 01.8 1.6L14 13.5V19a1 1 0 01-1.447.894l-2-1A1 1 0 019 18v-4.5L3.2 4.6A1 1 0 013 4z" />

                </svg>

                Filter

            </button> --}}

        </div>

        {{-- CARD LIST --}}
        <div class="space-y-5">

            @forelse ($attempts as $attempt)
                @php
                    $total = $attempt->score_twk + $attempt->score_tiu + $attempt->score_tkp;
                    $questionCount = $attempt->package?->questions()->count() ?? 0;
                @endphp

                <div
                    class="attempt-card border border-[#FF7A47] rounded-3xl bg-white p-5 sm:p-6 shadow-sm hover:shadow-md transition">

                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

                        <div class="flex-1">

                            <h2 class="text-xl font-bold">
                                {{ $attempt->package->name ?? 'Paket tidak ditemukan' }}
                            </h2>
                            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-400 mb-4">

                                <div class="flex items-center gap-1">
                                    {{ $questionCount }} Soal
                                </div>

                                <div class="flex items-center gap-1">
                                    {{ $attempt->package->duration_minutes ?? '-' }} Menit
                                </div>

                                <div class="flex items-center gap-1">
                                    {{ $attempt->finished_at ? $attempt->finished_at->format('d M Y H:i') : '-' }}
                                </div>

                            </div>

                            <div class="flex items-center gap-3 flex-wrap">

                                <h3 class="text-xl font-bold">
                                    Skor
                                    <span class="text-[#FF7A47]">
                                        {{ $total }}
                                    </span>
                                </h3>

                                <span class="text-sm bg-orange-100 text-[#FF7A47] px-3 py-1 rounded-lg font-semibold">
                                    TWK {{ $attempt->score_twk }} | TIU {{ $attempt->score_tiu }} | TKP
                                    {{ $attempt->score_tkp }}
                                </span>

                            </div>
                            @if (!$attempt->package?->show_explanation)
                                <span
                                    class="inline-flex mt-1 py-1 rounded-full text-gray-500 text-xs font-medium">
                                    Paket gratis tidak menyediakan fitur review pembahasan
                                </span>
                            @endif

                        </div>

                        <div class="flex flex-col gap-3 w-full sm:w-auto">

                            @if ($attempt->package?->show_explanation)
                                <a href="{{ route('tryout.result', $attempt->id) }}"
                                    class="text-center bg-[#FFA35C] text-white px-5 py-2 rounded-xl hover:bg-[#F28C45] transition font-medium">
                                    Review
                                </a>
                            @endif

                            <form action="{{ route('tryout.start', $attempt->package_id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full bg-[#FFA35C] text-white px-5 py-2 rounded-xl hover:bg-[#f06a37] transition font-medium">
                                    Kerjakan Ulang
                                </button>
                            </form>

                        </div>

                    </div>

                </div>
            @empty
                <div class="bg-white border border-[#FF7A47] rounded-3xl p-8 text-center">
                    <h2 class="text-xl font-bold text-gray-800 mb-2">
                        Belum ada riwayat tryout
                    </h2>
                    <p class="text-gray-500 mb-6">
                        Kerjakan tryout terlebih dahulu untuk melihat hasilmu di sini.
                    </p>
                    <a href="{{ route('tryout') }}"
                        class="inline-block bg-[#FF7A47] text-white px-6 py-3 rounded-xl font-bold hover:bg-[#f06a37] transition">
                        Lihat Paket Tryout
                    </a>
                </div>
            @endforelse
            <div id="emptyMessage" class="hidden bg-white border border-[#FF7A47] rounded-3xl p-8 text-center">
                <h2 class="text-xl font-bold text-gray-800 mb-2">
                    Riwayat tidak ditemukan
                </h2>
                <p class="text-gray-500">
                    Tidak ada riwayat yang cocok dengan pencarian.
                </p>
            </div>
        </div>
        @if ($attempts->hasPages())
            <div id="paginationWrapper" class="mt-8">
                {{ $attempts->links() }}
            </div>
        @endif
    </main>
    <script>
        const searchInput = document.getElementById('searchInput');
        const emptyMessage = document.getElementById('emptyMessage');
        const paginationWrapper = document.getElementById('paginationWrapper');

        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const keyword = this.value.toLowerCase().trim();
                let visible = 0;

                document.querySelectorAll('.attempt-card').forEach(card => {
                    const text = card.innerText.toLowerCase();

                    if (text.includes(keyword)) {
                        card.classList.remove('hidden');
                        visible++;
                    } else {
                        card.classList.add('hidden');
                    }
                });

                if (paginationWrapper) {
                    keyword !== '' ?
                        paginationWrapper.classList.add('hidden') :
                        paginationWrapper.classList.remove('hidden');
                }

                if (visible === 0 && keyword !== '') {
                    emptyMessage.classList.remove('hidden');
                } else {
                    emptyMessage.classList.add('hidden');
                }
            });
        }
    </script>
</body>

</html>
