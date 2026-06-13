<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel Admin</title>

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/admin.js'])
    <link rel="icon" type="image/png" href="{{ asset('images/juaraASNco.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-[#F5F5F5] text-gray-800" style="font-family: 'Poppins', sans-serif;">

    {{-- SIDEBAR --}}
    @include('components.sideadmin')
    <!-- MOBILE NAVBAR -->
    <div class="lg:hidden fixed top-0 left-0 w-full h-16 z-40 bg-[#FFA35C] shadow-md px-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <button id="openSidebar" class="p-2 rounded-lg hover:bg-white/20 transition text-white">
                ☰
            </button>

            <h1 class="text-lg font-semibold text-white">
                Artikel
            </h1>
        </div>
    </div>
    {{-- MAIN --}}
    <main class="lg:ml-64 min-h-screen mt-14 lg:mt-0 p-4 sm:p-6">
        {{-- HEADER --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

            <div>
                <h1 class="text-2xl sm:text-3xl font-bold">
                    DAFTAR ARTIKEL
                </h1>
            </div>

            {{-- Tambah Artikel Button --}}
            <a href="{{ route('admin.articles.create') }}"
                class="bg-[#FFA35C] text-white px-5 py-3 rounded-xl font-semibold shadow hover:scale-105 transition w-full sm:w-auto text-center">
                Tambah Artikel
            </a>

        </div>

        {{-- SEARCH --}}
        <div class="flex flex-col sm:flex-row gap-3 mb-8">

            {{-- SEARCH INPUT --}}
            <div class="relative flex-1">

                <input type="text" id="searchInput" placeholder="Cari artikel..."
                    class="w-full bg-white rounded-xl border border-gray-200 pl-11 pr-4 py-3 outline-none focus:ring-2 focus:ring-orange-300">

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
                class="bg-[#7FA7FF] text-gray-800 px-5 py-3 rounded-xl flex items-center justify-center gap-2 hover:scale-105 transition">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 4a1 1 0 011-1h16a1 1 0 01.8 1.6L14 13.5V19a1 1 0 01-1.447.894l-2-1A1 1 0 019 18v-4.5L3.2 4.6A1 1 0 013 4z" />
                </svg>

                Filter

            </button> --}}

        </div>

        {{-- CARD GRID --}}
        <div id="articleGrid"
            class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6 max-h-[620px] overflow-y-auto pr-2">
            @forelse ($articles as $article)
                <div class="article-card bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-xl transition">

                    <div class="bg-[#FFA35C] py-4 px-4 text-center">
                        <h2 class="text-white font-bold text-lg sm:text-xl uppercase">
                            {{ Str::limit($article->title, 35) }}
                        </h2>
                    </div>

                    <div class="aspect-video bg-[#F3F3F3] overflow-hidden">
                         @if($article->image)
                            <img src="{{ asset('storage/' . $article->image) }}"
                                class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                Tidak ada gambar
                            </div>
                        @endif
                    </div>

                    <div class="px-5 py-4">
                        <p class="text-sm text-gray-500">
                            {{ $article->is_published ? 'Published' : 'Draft' }}
                        </p>
                    </div>

                    <div class="flex justify-end items-center gap-4 px-5 py-4 border-t">

                        <a href="{{ route('admin.articles.edit', $article->id) }}"
                            class="text-gray-700 hover:text-orange-500 transition">
                            Edit
                        </a>

                        <form action="{{ route('admin.articles.destroy', $article->id) }}"
                            method="POST"
                            onsubmit="return confirm('Hapus artikel ini?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="text-gray-700 hover:text-red-500 transition">
                                Hapus
                            </button>
                        </form>

                    </div>

                </div>
            @empty
                <div class="col-span-full bg-white rounded-3xl p-8 text-center text-gray-500">
                    Belum ada artikel.
                </div>
            @endforelse                      
        </div>
        <div id="emptyMessage" class="hidden bg-white rounded-3xl p-8 text-center text-gray-500 mt-6">
            Tidak ada artikel yang ditemukan.
        </div>
        <div id="paginationWrapper" class="mt-8">
            {{ $articles->links() }}
        </div>
    </main>
</body>
<script>
    const searchInput = document.getElementById('searchInput');

    searchInput.addEventListener('input', function () {
        const keyword = this.value.toLowerCase().trim();
        let visible = 0;

        document.querySelectorAll('.article-card').forEach(card => {
            const text = card.innerText.toLowerCase();

            if (text.includes(keyword)) {
                card.style.display = 'block';
                visible++;
            } else {
                card.style.display = 'none';
            }
        });

        const emptyMessage = document.getElementById('emptyMessage');
        const paginationWrapper = document.getElementById('paginationWrapper');

        if (paginationWrapper) {
            keyword !== ''
                ? paginationWrapper.classList.add('hidden')
                : paginationWrapper.classList.remove('hidden');
        }

        if (visible === 0) {
            emptyMessage.classList.remove('hidden');
        } else {
            emptyMessage.classList.add('hidden');
        }
    });
</script>
</html>
