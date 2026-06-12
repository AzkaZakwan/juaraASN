<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Bank Soal</title>

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/admin.js'])

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-[#F3F3F3]" style="font-family: 'Poppins', sans-serif;">

    @include('components.sideadmin')

    <!-- MOBILE NAVBAR -->
    <div class="lg:hidden fixed top-0 left-0 w-full h-16 z-40 bg-[#FFA35C] shadow-md px-4 flex items-center justify-between">
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

        <h1 class="text-4xl font-bold mb-6">
            BANK SOAL
        </h1>

        @if(session('success'))
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

                <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                    🔍
                </div>
            </div>
        </div>
        {{-- error validation --}}
        @if(session('error'))
            <div class="mb-4 bg-red-100 text-red-700 px-4 py-3 rounded-xl">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        <!-- CARD -->
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

            <!-- TAB -->
            <div class="grid grid-cols-3">
                <button type="button" onclick="showTab('TWK')" data-tab="TWK"
                    class="tab-btn bg-[#FF6B1A] text-white font-bold py-3 text-lg hover:bg-[#FFA35C] transition">
                    TWK
                </button>

                <button type="button" onclick="showTab('TIU')" data-tab="TIU"
                    class="tab-btn bg-gray-200 text-gray-700 font-bold py-3 text-lg hover:bg-[#FFA35C] transition">
                    TIU
                </button>

                <button type="button" onclick="showTab('TKP')" data-tab="TKP"
                    class="tab-btn bg-gray-200 text-gray-700 font-bold py-3 text-lg hover:bg-[#FFA35C] transition">
                    TKP
                </button>
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
                                        Soal {{ $category }} #{{ $loop->iteration }}
                                    </h2>

                                    <div class="flex flex-wrap gap-2 mb-3">
                                        <span class="bg-orange-100 text-orange-600 text-xs font-semibold px-3 py-1 rounded-full">
                                            {{ $category }}
                                        </span>

                                        <span class="bg-gray-100 text-gray-600 text-xs font-semibold px-3 py-1 rounded-full">
                                            {{ $question->sub_category ?? 'Tanpa Subkategori' }}
                                        </span>
                                    </div>

                                    <p class="question-text text-sm text-gray-500">
                                        {{ Str::limit($question->question_text, 120) }}
                                    </p>

                                    @if($question->question_image)
                                        <img
                                            src="{{ asset('storage/' . $question->question_image) }}"
                                            alt="Gambar Soal"
                                            class="mt-3 max-h-40 rounded-xl border object-contain bg-white p-2">
                                    @endif
                                </div>

                                <div class="flex gap-2">

                                    <a href="{{ route('questions.edit', $question->id) }}"
                                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-xl text-sm transition">
                                        Edit
                                    </a>

                                    <form action="{{ route('questions.destroy', $question->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Hapus soal ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl text-sm transition">
                                            Hapus
                                        </button>
                                    </form>

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

            </div>
        </div>
    </main>

    <script>
        let activeTab = 'ALL';

        function showTab(category) {
            activeTab = category;

            document.querySelectorAll('.tab-btn').forEach(btn => {
                if (btn.dataset.tab === category) {
                    btn.classList.remove('bg-gray-200', 'text-gray-700');
                    btn.classList.add('bg-[#FFA35C]', 'text-white');
                } 
                else {
                    btn.classList.remove('bg-[#FFA35C]', 'text-white');
                    btn.classList.add('bg-gray-200', 'text-[-700');
                }
            });

            filterQuestions();
        }

        function filterQuestions() {
            const keyword = document.getElementById('searchInput').value.toLowerCase().trim();
            let visibleCount = 0;

            document.querySelectorAll('.question-card').forEach(card => {
                const category = card.dataset.category;
                const text = card.innerText.toLowerCase();

                const matchCategory = activeTab === 'ALL' || category === activeTab;
                const matchSearch = text.includes(keyword);

                if (matchCategory && matchSearch) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            const emptyMessage = document.getElementById('emptyMessage');

            if (visibleCount === 0) {
                emptyMessage.classList.remove('hidden');

                if (keyword !== '') {
                    emptyMessage.innerText = 'Tidak ada soal yang cocok dengan pencarian.';
                } else {
                    emptyMessage.innerText = 'Belum ada soal pada kategori ini.';
                }
            } else {
                emptyMessage.classList.add('hidden');
                emptyMessage.innerText = '';
            }
        }
        document.getElementById('searchInput').addEventListener('input', filterQuestions);
        showTab('TWK');
    </script>

</body>
</html>