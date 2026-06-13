<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Try Out</title>

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/admin.js'])
    <link rel="icon" type="image/png" href="{{ asset('images/juaraASNco.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-[#F3F3F3]" style="font-family: 'Poppins', sans-serif;">

    @include('components.sideadmin')

    <!-- MOBILE NAVBAR -->
    <div
        class="lg:hidden fixed top-0 left-0 w-full h-16 z-40 bg-[#FFA35C] shadow-md px-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <button id="openSidebar" class="p-2 rounded-lg hover:bg-white/20 transition text-white">
                ☰
            </button>

            <h1 class="text-lg font-semibold text-white">
                Manajemen Try Out
            </h1>
        </div>
    </div>

    <!-- CONTENT -->
    <main class="lg:ml-64 min-h-screen p-4 sm:p-6 lg:p-8 mt-16 lg:mt-0">

        <div class="bg-white rounded-3xl shadow-xl p-5 sm:p-8 lg:p-10 w-full max-w-5xl mx-auto">

            <h1 class="text-4xl font-bold mb-8">
                Daftar Try Out
            </h1>

            @if (session('error'))
                <div class="mb-4 bg-red-100 text-red-700 px-4 py-3 rounded-xl">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            <!-- SEARCH -->
            <div class="flex gap-3 mb-6">
                <div class="relative flex-1">

                    <input type="text" id="searchInput" placeholder="Cari Try Out..."
                        class="w-full bg-white rounded-xl shadow px-10 py-3 outline-none focus:ring-2 focus:ring-orange-300">

                    {{-- ICON --}}
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m21 21-4.35-4.35m1.85-5.65a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z" />
                    </svg>

                </div>
            </div>
            <div id="packageList" class="space-y-4 max-h-[550px] overflow-y-auto pr-2">
                @forelse ($packages as $package)
                    <div
                        class="package-card bg-[#FFA35C] rounded-xl p-5 flex items-center justify-between shadow-md hover:scale-[1.01] transition">

                        <div class="text-white">
                            <h2 class="font-bold text-lg">
                                {{ $package->name }}
                            </h2>

                            <div class="mb-1">
                                <span
                                    class="text-xs font-bold px-3 py-1 rounded-full
                                    {{ $package->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $package->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </div>

                            <p class="text-sm">
                                {{ $package->questions_count }} Soal
                                {{ $package->duration_minutes ?? 100 }} Menit ·
                                {{ $package->price == 0 ? 'Gratis' : 'Premium · Rp ' . number_format($package->price, 0, ',', '.') }}
                            </p>
                        </div>

                        <div class="flex gap-2">
                            <form action="{{ route('packages.toggleActive', $package->id) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <button type="submit"
                                    class="bg-white hover:bg-gray-50 text-gray-800 px-3 h-10 rounded-lg flex items-center justify-center hover:scale-110 transition text-sm font-semibold shadow-sm">
                                    {{ $package->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                </button>
                            </form>

                            <a href="{{ route('packages.edit', $package->id) }}"
                                class="bg-white text-gray-800 w-10 h-10 rounded-lg flex items-center justify-center hover:scale-110 transition">
                                ✎
                            </a>

                            <a href="{{ route('packages.questions', $package->id) }}"
                                class="bg-white text-gray-800 px-3 h-10 rounded-lg flex items-center justify-center hover:scale-110 transition text-sm font-semibold">
                                Soal
                            </a>

                        </div>
                    </div>
                @empty
                    <div class="text-center text-gray-500 py-10">
                        Belum ada paket try out.
                    </div>
                @endforelse
                <div id="emptyMessage" class="hidden text-center text-gray-500 py-10">
                </div>

            </div>

            @if ($packages->hasPages())
                <div class="flex justify-center items-center gap-3 mt-8">

                    @if ($packages->onFirstPage())
                        <span class="px-4 py-2 bg-gray-100 text-gray-400 rounded-lg">
                            Previous
                        </span>
                    @else
                        <a href="{{ $packages->previousPageUrl() }}"
                            class="px-4 py-2 bg-white border text-gray-700 rounded-lg hover:bg-gray-100">
                            Previous
                        </a>
                    @endif

                    <span class="text-sm text-gray-500">
                        Page {{ $packages->currentPage() }} of {{ $packages->lastPage() }}
                    </span>

                    @if ($packages->hasMorePages())
                        <a href="{{ $packages->nextPageUrl() }}"
                            class="px-4 py-2 bg-white border text-gray-700 rounded-lg hover:bg-gray-100">
                            Next
                        </a>
                    @else
                        <span class="px-4 py-2 bg-gray-100 text-gray-400 rounded-lg">
                            Next
                        </span>
                    @endif

                </div>
            @endif

            <div class="flex justify-end mt-8">
                <a href="{{ route('packages.create') }}"
                    class="bg-[#FFA35C] hover:bg-[#de8f52] text-white px-6 py-2 rounded-xl shadow-md hover:shadow-lg transition">
                    + Try Out
                </a>
            </div>

        </div>

    </main>
    <script>
        const searchInput = document.getElementById('searchInput');

        searchInput.addEventListener('input', function() {

            const keyword = this.value.toLowerCase().trim();
            let visible = 0;

            document.querySelectorAll('.package-card').forEach(card => {

                const text = card.innerText.toLowerCase();

                if (text.includes(keyword)) {
                    card.style.display = 'flex';
                    visible++;
                } else {
                    card.style.display = 'none';
                }

            });

            const empty = document.getElementById('emptyMessage');

            if (visible === 0) {
                empty.classList.remove('hidden');
                empty.innerText = 'Tidak ada paket try out yang ditemukan.';
            } else {
                empty.classList.add('hidden');
            }

        });
    </script>
</body>

</html>
