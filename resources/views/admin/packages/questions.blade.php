<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Soal Paket</title>

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
            Kelola Soal Paket
        </h1>
    </div>
</div>

<main class="lg:ml-64 min-h-screen mt-16 lg:mt-0 p-4 sm:p-6">

    <!-- HEADER -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">

        <div>
            <p class="text-sm text-gray-500">
                Home > Manajemen Try Out > Kelola Soal Paket
            </p>

            <h1 class="text-2xl sm:text-3xl font-bold mt-1">
                Kelola Soal Paket
            </h1>

            <p class="text-gray-500 mt-1">
                Paket:
                <span class="font-semibold text-gray-800">
                    {{ $package->name }}
                </span>
            </p>
        </div>

        <button form="formSoal" type="submit"
            class="bg-[#FFA35C] text-white px-5 py-3 rounded-xl font-semibold shadow hover:scale-105 transition w-full sm:w-auto">
            Simpan Soal Paket
        </button>

    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    @error('questions')
        <div class="mb-4 bg-red-100 text-red-700 px-4 py-3 rounded-xl">
            {{ $message }}
        </div>
    @enderror

    <form id="formSoal" action="{{ route('packages.questions.store', $package->id) }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">

            <!-- LEFT LIST -->
            <div class="xl:col-span-5 bg-white rounded-3xl shadow-lg overflow-hidden">

                <!-- TAB -->
                <div class="grid grid-cols-3">
                    <button type="button" onclick="showTab('TWK')" data-tab="TWK"
                        class="tab-btn bg-[#FF6B2C] text-white py-3 font-bold transition hover:bg-gray-300 transition">
                        TWK
                    </button>

                    <button type="button" onclick="showTab('TIU')" data-tab="TIU"
                        class="tab-btn bg-gray-200 text-gray-700 py-3 font-bold border-x border-gray-300 transition hover:bg-gray-300 transition">
                        TIU
                    </button>

                    <button type="button" onclick="showTab('TKP')" data-tab="TKP"
                        class="tab-btn bg-gray-200 text-gray-700 py-3 font-bold transition hover:bg-gray-300 transition">
                        TKP
                    </button>
                </div>

                <!-- SEARCH -->
                <div class="p-4">
                    <input type="text" id="searchInput" placeholder="Cari soal..."
                        class="w-full bg-[#F7F7F7] rounded-xl border border-gray-200 px-4 py-3 outline-none focus:ring-2 focus:ring-orange-300 text-sm">
                </div>

                <!-- QUESTIONS -->
                <div class="px-4 pb-4 h-[500px] overflow-y-auto space-y-3">

                    @forelse ($questions as $question)
                        @php
                            $category = strtoupper($question->question_type ?? 'TWK');
                        @endphp

                        <label class="question-item block border border-gray-200 rounded-2xl p-4 hover:border-[#FF6B2C] transition cursor-pointer"
                            data-category="{{ $category }}">

                            <div class="flex gap-3">

                                <input type="checkbox"
                                    name="questions[]"
                                    value="{{ $question->id }}"
                                    class="question-checkbox mt-1 w-5 h-5"
                                    data-category="{{ $category }}"
                                    {{ in_array($question->id, $selectedQuestions) ? 'checked' : '' }}>

                                <div class="flex-1">

                                    <div class="flex flex-wrap gap-2 mb-2">
                                        <span class="inline-block text-xs font-bold px-3 py-1 rounded-full
                                            {{ $category == 'TWK' ? 'bg-blue-100 text-blue-600' : '' }}
                                            {{ $category == 'TIU' ? 'bg-green-100 text-green-600' : '' }}
                                            {{ $category == 'TKP' ? 'bg-purple-100 text-purple-600' : '' }}">
                                            {{ $category }}
                                        </span>

                                        <span class="sub-category inline-block text-xs font-bold px-3 py-1 rounded-full bg-gray-100 text-gray-600">
                                            {{ $question->sub_category ?? 'Tanpa Subkategori' }}
                                        </span>
                                    </div>

                                    <p class="question-text text-sm font-semibold text-gray-800">
                                        {{ Str::limit($question->question_text, 120) }}
                                    </p>

                                    @if($question->question_image)
                                        <img
                                            src="{{ asset('storage/' . $question->question_image) }}"
                                            alt="Gambar Soal"
                                            class="mt-3 w-full max-h-40 object-contain rounded-lg border">
                                    @endif

                                </div>

                            </div>

                        </label>
                    @empty
                        <div class="text-center text-gray-500 py-10">
                            Belum ada soal di bank soal.
                        </div>
                    @endforelse

                </div>

            </div>

            <!-- RIGHT INFO -->
            <div class="xl:col-span-7 bg-white rounded-3xl shadow-lg p-5 sm:p-6">

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

                    <div class="space-y-4">

                        <div>
                            <h3 class="font-bold mb-2">Nama Try Out</h3>
                            <div class="bg-[#ECECEC] rounded-lg px-4 py-3">
                                {{ $package->name }}
                            </div>
                        </div>

                        <div>
                            <h3 class="font-bold mb-2">Status</h3>
                            <div class="bg-[#ECECEC] rounded-lg px-4 py-3">
                                {{ $package->price == 0 ? 'Gratis' : 'Premium' }}
                            </div>
                        </div>

                        <div>
                            <h3 class="font-bold mb-2">Harga</h3>
                            <div class="bg-[#ECECEC] rounded-lg px-4 py-3">
                                {{ $package->price == 0 ? 'Rp 0' : 'Rp ' . number_format($package->price, 0, ',', '.') }}
                            </div>
                        </div>

                    </div>

                    <div>
                        <h3 class="font-bold mb-4">Total Terpilih</h3>

                        <div class="grid grid-cols-3 gap-4">

                            <div class="text-center">
                                <div id="countTWK" class="bg-[#D9D9D9] rounded-lg h-12 mb-2 flex items-center justify-center font-bold">
                                    0
                                </div>
                                <p class="font-bold text-sm">TWK</p>
                            </div>

                            <div class="text-center">
                                <div id="countTIU" class="bg-[#D9D9D9] rounded-lg h-12 mb-2 flex items-center justify-center font-bold">
                                    0
                                </div>
                                <p class="font-bold text-sm">TIU</p>
                            </div>

                            <div class="text-center">
                                <div id="countTKP" class="bg-[#D9D9D9] rounded-lg h-12 mb-2 flex items-center justify-center font-bold">
                                    0
                                </div>
                                <p class="font-bold text-sm">TKP</p>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="bg-[#F3F3F3] rounded-3xl min-h-[350px] p-5">
                    <h2 class="font-bold text-xl mb-4">
                        Soal Terpilih
                    </h2>

                    <div id="selectedPreview" class="space-y-3 text-sm text-gray-700">
                        Belum ada soal yang dipilih.
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <a href="{{ route('packages.index') }}"
                        class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-xl shadow-md transition">
                        Kembali
                    </a>
                </div>

            </div>

        </div>

    </form>

</main>

<script>
    let activeTab = 'TWK';

    function showTab(category) {
        activeTab = category;

        document.querySelectorAll('.tab-btn').forEach(btn => {
            if (btn.dataset.tab === category) {
                btn.classList.remove('bg-gray-200', 'text-gray-700');
                btn.classList.add('bg-[#FFA35C]', 'text-white');
            } else {
                btn.classList.remove('bg-[#FFA35C]', 'text-white');
                btn.classList.add('bg-gray-200', 'text-gray-700');
            }
        });

        filterQuestions();
    }

    function filterQuestions() {
        const keyword = document.getElementById('searchInput').value.toLowerCase();

        document.querySelectorAll('.question-item').forEach(item => {
            const category = item.dataset.category;
            const text = item.innerText.toLowerCase();
            item.style.display =
                category === activeTab && text.includes(keyword)
                    ? 'block'
                    : 'none';
        });
    }

    function updateCounts() {
        let twk = 0;
        let tiu = 0;
        let tkp = 0;

        const preview = document.getElementById('selectedPreview');
        preview.innerHTML = '';

        document.querySelectorAll('.question-checkbox:checked').forEach(checkbox => {
            const category = checkbox.dataset.category;

            if (category === 'TWK') twk++;
            if (category === 'TIU') tiu++;
            if (category === 'TKP') tkp++;

            const item = checkbox.closest('.question-item');
            const text = item.querySelector('.question-text').innerText;
            const subCategory = item.querySelector('.sub-category')?.innerText || '';

            preview.innerHTML += `
                <div class="bg-white rounded-xl px-4 py-3 shadow-sm border">
                    <div class="mb-1">
                        <span class="font-bold text-[#FFA35C]">${category}</span>
                        <span class="text-gray-500"> | ${subCategory}</span>
                    </div>
                    <div>${text}</div>
                </div>
            `;
        });

        const targetTWK = 1;
        const targetTIU = 1;
        const targetTKP = 1;

        document.getElementById('countTWK').innerText = `${twk} / ${targetTWK}`;
        document.getElementById('countTIU').innerText = `${tiu} / ${targetTIU}`;
        document.getElementById('countTKP').innerText = `${tkp} / ${targetTKP}`;

        setCountColor('countTWK', twk, targetTWK);
        setCountColor('countTIU', tiu, targetTIU);
        setCountColor('countTKP', tkp, targetTKP);

        if (preview.innerHTML.trim() === '') {
            preview.innerHTML = 'Belum ada soal yang dipilih.';
        }
    }

    function setCountColor(id, current, target) {
        const el = document.getElementById(id);

        el.classList.remove('bg-[#D9D9D9]', 'bg-green-100', 'text-green-700', 'bg-red-100', 'text-red-700');

        if (current === target) {
            el.classList.add('bg-green-100', 'text-green-700');
        } else {
            el.classList.add('bg-red-100', 'text-red-700');
        }
    }

    document.getElementById('searchInput').addEventListener('input', filterQuestions);

    document.querySelectorAll('.question-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', updateCounts);
    });

    showTab('TWK');
    updateCounts();
</script>

</body>
</html>