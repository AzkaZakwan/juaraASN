<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Try Out</title>
    <link rel="icon" type="image/png" href="{{ asset('images/juaraASNco.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-[#FFF5F0] antialiased text-gray-800" style="font-family: 'Poppins', sans-serif;">

    @include('components.sidebar')
    @include('components.navbar')

    <!-- OVERLAY -->
    <div id="overlay" class="fixed inset-0 bg-black/40 z-40 hidden opacity-0 transition-opacity duration-300">
    </div>

    
    <!-- Content -->
    <div class="max-w-6xl mx-auto p-6 mt-4 pt-20">

        {{-- BACK --}}
        <a href="{{ route('dashboard') }}" class="inline-block hover:scale-110 transition">

            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">

                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />

            </svg>

        </a>

        <!-- Title -->
        <h1 class="text-4xl font-bold mb-1">Try Out SKD</h1>
        <p class="font-semibold mb-6">
            Menguji pemahaman pelajar melalui soal dan try out
        </p>

        @if(session('success'))
            <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 bg-red-100 text-red-700 px-4 py-3 rounded-xl">
                {{ session('error') }}
            </div>
        @endif

        <!-- Search + Filter -->
        <div class="flex flex-col sm:flex-row gap-3 mb-6">
            <input id="searchPackage" type="text" placeholder="Cari paket..."
                class="w-full border border-gray-300 rounded-xl px-4 py-3 outline-none focus:outline-none focus:ring-0 focus:border-[#FFA35C] focus:shadow-none
                transition">

            <select id="filterPackage"
                class="w-36 border border-gray-300 rounded-xl px-4 py-3 bg-white outline-none focus:outline-none focus:ring-0 focus:border-[#FFA35C] focus:shadow-none
                transition">
                <option value="all">Semua</option>
                <option value="free">Gratis</option>
                <option value="premium">Premium</option>
            </select>
        </div>

        <!-- Grid -->
        <div class=" grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

            @foreach ($packages as $package)
                <div class="package-card border-2 border-[#FFA35C] rounded-xl p-4 hover:shadow-lg transition"
                    data-name="{{ strtolower($package->name) }}"
                    data-status="{{ $package->price == 0 ? 'free' : 'premium' }}">

                    <h2 class="font-semibold mb-2">
                        Try Out - {{ $package->name }}
                    </h2>

                    <!-- Badge -->
                    @if($package->price == 0)
                        <span class="text-xs bg-green-100 text-green-600 px-3 py-1 rounded-full">
                            Gratis
                        </span>
                    @else
                        <span class="text-xs bg-orange-100 text-[#FF7A47] px-3 py-1 rounded-full">
                            Premium
                        </span>
                    @endif

                    <!-- Info -->
                    <div class="flex gap-4 text-xs text-gray-500 mt-3">
                        <span>📄 {{ $package->questions->count() }} Soal</span>
                        <span>⏱ {{ $package->duration_minutes }} Menit</span>
                    </div>

                    <!-- Button -->
                    <div class="flex gap-2 mt-4">
                        @if($package->price == 0 || in_array($package->id, $userPackageIds))
                            <a href="{{ route('prepare', $package->id) }}"
                                class="w-full bg-[#6FD8CA] text-center text-white py-2 rounded-lg hover:bg-[#59C4B5] transition">
                                Kerjakan
                            </a>
                        @else
                            <a href="{{ route('tryout.buy', $package->id) }}"
                                class="w-full bg-[#FF7A47] text-center text-white py-2 rounded-lg hover:bg-[#f06b38] transition">
                                Beli Paket
                            </a>
                        @endif

                        <button type="button"
                            class="openRanking w-full bg-[#FF7A47] text-center text-white py-2 rounded-lg hover:bg-[#f06b38] transition"
                            data-package-id="{{ $package->id }}">
                            Ranking
                        </button>

                    </div>

                </div>

                <div id="rankingOverlay-{{ $package->id }}"
                    class="rankingOverlay fixed inset-0 bg-black/50 z-[60] hidden opacity-0 transition-opacity duration-300">

                    <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 bg-white rounded-3xl shadow-2xl w-[95%] sm:w-[90%] md:w-[700px] max-h-[85vh] overflow-hidden">

                        <div class="bg-[#FFA35C] text-white px-6 py-4 flex items-center justify-between">
                            <h2 class="text-lg sm:text-2xl font-bold">
                                Ranking {{ $package->name }}
                            </h2>

                            <button type="button"
                                class="closeRanking text-2xl hover:scale-110 transition"
                                data-package-id="{{ $package->id }}">
                                ✕
                            </button>
                        </div>

                        <div class="p-5 space-y-4 overflow-y-auto max-h-[70vh]">

                            @forelse ($rankings[$package->id] as $index => $attempt)
                                @php
                                    $total = $attempt->score_twk + $attempt->score_tiu + $attempt->score_tkp;
                                @endphp

                                <div class="bg-[#FFF7F2] border border-orange-100 rounded-2xl p-4">

                                    <div class="flex justify-between items-start">

                                        <div>
                                            <div class="flex items-center gap-3">
                                                <span class="font-bold text-[#FF7A47]">
                                                    #{{ $index + 1 }}
                                                </span>

                                                <h3 class="font-semibold">
                                                    {{ $attempt->user->name }}
                                                </h3>
                                            </div>

                                            <p class="text-sm text-gray-600 mt-1">
                                                TWK: {{ $attempt->score_twk }}
                                                |
                                                TIU: {{ $attempt->score_tiu }}
                                                |
                                                TKP: {{ $attempt->score_tkp }}
                                            </p>
                                        </div>

                                        <div class="text-right">
                                            <p class="font-bold text-[#FF7A47]">
                                                {{ $total }}
                                            </p>

                                            <p class="text-xs text-gray-500">
                                                {{ $attempt->finished_at?->format('d M Y') }}
                                            </p>
                                        </div>

                                    </div>

                                </div>

                            @empty
                                <div class="text-center text-gray-500 py-8">
                                    Belum ada ranking untuk paket ini.
                                </div>
                            @endforelse

                        </div>

                    </div>
                </div>
            @endforeach

        </div>

        <div id="emptyPackage"
            class="hidden text-center py-12">

            <h3 class="text-2xl font-bold text-gray-500">
                Paket tidak ditemukan
            </h3>

            <p class="text-gray-400 mt-2">
                Coba gunakan kata kunci lain.
            </p>

        </div>

        <div class="mt-8">
            {{ $packages->links() }}
        </div>

    </div>
    @include('components.footer')
    {{-- @include('components.ranking') --}}
</body>

<script>
    document.querySelectorAll('.openRanking').forEach(button => {
        button.addEventListener('click', function () {
            const packageId = this.dataset.packageId;
            const overlay = document.getElementById(`rankingOverlay-${packageId}`);

            overlay.classList.remove('hidden');

            setTimeout(() => {
                overlay.classList.remove('opacity-0');
                overlay.classList.add('opacity-100');
            }, 10);
        });
    });

    document.querySelectorAll('.closeRanking').forEach(button => {
        button.addEventListener('click', function () {
            const packageId = this.dataset.packageId;
            const overlay = document.getElementById(`rankingOverlay-${packageId}`);

            overlay.classList.remove('opacity-100');
            overlay.classList.add('opacity-0');

            setTimeout(() => {
                overlay.classList.add('hidden');
            }, 300);
        });
    });

    const searchPackage = document.getElementById('searchPackage');
    const filterPackage = document.getElementById('filterPackage');

    function filterPackages() {
        const keyword = searchPackage.value.toLowerCase();
        const status = filterPackage.value;

        let visibleCount = 0;

        document.querySelectorAll('.package-card').forEach(card => {
            const name = card.dataset.name;
            const cardStatus = card.dataset.status;

            const matchName = name.includes(keyword);
            const matchStatus =
                status === 'all' || status === cardStatus;

            if (matchName && matchStatus) {
                card.style.display = '';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        const emptyPackage =
            document.getElementById('emptyPackage');

        if (visibleCount === 0) {
            emptyPackage.classList.remove('hidden');
        } else {
            emptyPackage.classList.add('hidden');
        }
    }
    if (searchPackage && filterPackage) {
        searchPackage.addEventListener('input', filterPackages);
        filterPackage.addEventListener('change', filterPackages);
    }
</script>

</html>

