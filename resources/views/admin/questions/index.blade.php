<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Bank Soal</title>

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
                Manajemen Bank Soal
            </h1>
        </div>
    </div>

    <main class="lg:ml-64 min-h-screen p-4 sm:p-6 lg:p-8 mt-16 lg:mt-0">

        <h1 class="hidden lg:block text-4xl font-bold mb-6">
            BANK SOAL
        </h1>

        @if (session('success'))
            <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        <!-- ACTION -->
        <div class="flex items-center gap-3 mb-5">

            <a href="{{ route('questions.create') }}"
                class="bg-[#FFA35C] hover:bg-[#FF8C33] text-white px-6 py-2 rounded-xl shadow-md hover:shadow-lg transition">
                Tambah Soal
            </a>

        </div>

        <!-- SEARCH -->
        <div class="flex gap-3 mb-6">
            <div class="relative flex-1">
                <input type="text" id="searchInput" placeholder="Cari Bank Soal...."
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
        {{-- error validation --}}
        @if (session('error'))
            <div class="mb-4 bg-red-100 text-red-700 px-4 py-3 rounded-xl">
                {{ session('error') }}
            </div>
        @endif

        {{-- @if (session('success'))
            <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-xl">
                {{ session('success') }}
            </div>
        @endif --}}

        <!-- CARD -->
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

            <!-- TAB -->
            <div class="grid grid-cols-3">
                <a href="{{ route('questions.index', ['type' => 'TWK']) }}"
                    class="tab-btn {{ $activeTab === 'TWK' ? 'bg-[#FFA35C] text-white' : 'bg-gray-200 text-gray-700' }} font-bold py-3 text-lg text-center hover:bg-[#FFA35C] transition">
                    TWK
                </a>

                <a href="{{ route('questions.index', ['type' => 'TIU']) }}"
                    class="tab-btn {{ $activeTab === 'TIU' ? 'bg-[#FFA35C] text-white' : 'bg-gray-200 text-gray-700' }} font-bold py-3 text-lg text-center hover:bg-[#FFA35C] transition">
                    TIU
                </a>

                <a href="{{ route('questions.index', ['type' => 'TKP']) }}"
                    class="tab-btn {{ $activeTab === 'TKP' ? 'bg-[#FFA35C] text-white' : 'bg-gray-200 text-gray-700' }} font-bold py-3 text-lg text-center hover:bg-[#FFA35C] transition">
                    TKP
                </a>
            </div>

            <!-- CONTENT -->
            <div class="p-6 min-h-[500px]">

                <div class="space-y-4">

                    @forelse ($questions as $question)
                        @php
                            $category = strtoupper($question->question_type);
                        @endphp

                        <div class="question-card border rounded-2xl p-5 hover:border-[#FF6B1A] transition"
                            data-category="{{ $category }}">

                            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">

                                <div class="flex-1">
                                    <h2 class="font-bold text-lg mb-2">
                                        Soal {{ $category }} #{{ $questions->firstItem() + $loop->index }}
                                    </h2>

                                    <div class="flex flex-wrap gap-2 mb-3">
                                        <span
                                            class="bg-orange-100 text-orange-600 text-xs font-semibold px-3 py-1 rounded-full">
                                            {{ $category }}
                                        </span>

                                        {{-- <span
                                            class="bg-gray-100 text-gray-600 text-xs font-semibold px-3 py-1 rounded-full">
                                            {{ $question->sub_category ?? 'Tanpa Subkategori' }}
                                        </span> --}}
                                    </div>

                                    <p class="question-text text-sm text-gray-500">
                                        {{ Str::limit($question->question_text, 120) }}
                                    </p>

                                    @if ($question->question_image)
                                        <img src="{{ asset('storage/' . $question->question_image) }}"
                                            alt="Gambar Soal"
                                            class="mt-3 max-h-40 rounded-xl border object-contain bg-white p-2">
                                    @endif
                                </div>

                                <div class="flex gap-2">

                                    <a href="{{ route('questions.edit', $question->id) }}"
                                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-xl text-sm transition">
                                        Edit
                                    </a>

                                    {{-- <form action="{{ route('questions.destroy', $question->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Hapus soal ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl text-sm transition">
                                            Hapus
                                        </button>
                                    </form> --}}

                                </div>

                            </div>

                        </div>
                    @empty
                        <div class="text-center text-gray-500 py-10">
                            Belum ada soal di bank soal.
                        </div>
                    @endforelse
                    <div id="emptyMessage" class="hidden text-center text-gray-500 py-10">
                    </div>
                </div>
                @if ($questions->hasPages())
                    <div id="paginationWrapper" class="flex justify-center items-center gap-3 mt-8">

                        @if ($questions->onFirstPage())
                            <span class="px-4 py-2 bg-gray-100 text-gray-400 rounded-lg">
                                Previous
                            </span>
                        @else
                            <a href="{{ $questions->previousPageUrl() }}"
                                class="px-4 py-2 bg-white border text-gray-700 rounded-lg hover:bg-gray-100">
                                Previous
                            </a>
                        @endif

                        <span class="text-sm text-gray-500">
                            Page {{ $questions->currentPage() }} of {{ $questions->lastPage() }}
                        </span>

                        @if ($questions->hasMorePages())
                            <a href="{{ $questions->nextPageUrl() }}"
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

            </div>
        </div>
    </main>

    <script>
        function filterQuestions() {
            const keyword = document.getElementById('searchInput').value.toLowerCase().trim();
            const cards = document.querySelectorAll('.question-card');
            const emptyMessage = document.getElementById('emptyMessage');
            const paginationWrapper = document.getElementById('paginationWrapper');

            let visibleCount = 0;

            cards.forEach(card => {
                const text = card.innerText.toLowerCase();

                if (text.includes(keyword)) {
                    card.classList.remove('hidden');
                    visibleCount++;
                } else {
                    card.classList.add('hidden');
                }
            });

            if (paginationWrapper) {
                keyword !== '' ?
                    paginationWrapper.classList.add('hidden') :
                    paginationWrapper.classList.remove('hidden');
            }

            if (visibleCount === 0) {
                emptyMessage.classList.remove('hidden');
                emptyMessage.innerText = 'Tidak ada soal yang cocok dengan pencarian.';
            } else {
                emptyMessage.classList.add('hidden');
                emptyMessage.innerText = '';
            }
        }

        document.getElementById('searchInput').addEventListener('input', filterQuestions);
    </script>

</body>

</html>
