<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Soal</title>

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/admin.js'])
    <link rel="icon" type="image/png" href="{{ asset('images/juaraASNco.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-[#F3F3F3]" style="font-family: 'Poppins', sans-serif;">

    @include('components.sideadmin')
    <!-- MOBILE NAVBAR -->
    <div
        class="lg:hidden fixed top-0 left-0 w-full h-16 z-40 bg-[#FF6A26] shadow-md px-4 flex items-center justify-between">

        <div class="flex items-center gap-3">

            <button id="openSidebar" class="p-2 rounded-lg hover:bg-white/20 transition">

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6 text-white">

                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />

                </svg>

            </button>

            <h1 class="text-lg font-semibold text-white">
                Tambah Soal
            </h1>
        </div>
    </div>

    <main class="lg:ml-64 min-h-screen p-4 sm:p-6 lg:p-8 mt-16 lg:mt-0">

        <h1 class="text-3xl font-bold mb-6">
            Tambah Soal
        </h1>

        <form action="{{ route('questions.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-3xl shadow-xl p-5 sm:p-8 lg:p-10 w-full max-w-5xl space-y-6">
            @csrf
            <!-- Soal -->
            <div>
                <label class="font-semibold">Soal</label>

                <textarea name="question_text" rows="5" class="w-full border rounded-lg p-3 mt-2" required>{{ old('question_text') }}</textarea>
            </div>

            <!-- Gambar Soal -->
            <div>
                <label class="font-semibold">Gambar Soal <span class="text-gray-400 text-sm">(opsional)</span></label>

                <input type="file"
                    name="question_image"
                    accept="image/*"
                    class="w-full border rounded-lg p-3 mt-2">
            </div>

            <!-- Tipe -->
            <div>
                <label class="font-semibold">Tipe Soal</label>

                <select name="question_type" id="questionType"
                    class="w-full border rounded-lg p-3 mt-2">

                    <option value="TWK" {{ old('question_type') == 'TWK' ? 'selected' : '' }}>TWK</option>
                    <option value="TIU" {{ old('question_type') == 'TIU' ? 'selected' : '' }}>TIU</option>
                    <option value="TKP" {{ old('question_type') == 'TKP' ? 'selected' : '' }}>TKP</option>

                </select>
            </div>

            <!-- Sub Kategori -->
            {{-- <div>
                <label class="font-semibold">Sub Kategori</label>

                <select name="sub_category" id="subCategory"
                    class="w-full border rounded-lg p-3 mt-2" required>
                </select>
            </div> --}}

            @error('scores')
                <div class="bg-red-100 text-red-700 px-4 py-3 rounded-lg">
                    {{ $message }}
                </div>
            @enderror
            @error('correct_answer')
                <div class="bg-red-100 text-red-700 px-4 py-3 rounded-lg">
                    {{ $message }}
                </div>
            @enderror

            <!-- Opsi -->
            <div class="space-y-4">

                @foreach (['A','B','C','D','E'] as $key => $label)

                    <div class="border rounded-lg p-4">

                        <label class="font-semibold">
                            Opsi {{ $label }}
                        </label>

                        <input type="text"
                            name="options[]"
                            value="{{ old('options.' . $key) }}"
                            class="w-full border rounded-lg p-2 mt-2"
                            required>                                    
                        
                        <label class="block font-semibold mt-3">
                            Gambar Opsi {{ $label }} <span class="text-gray-400 text-sm">(opsional)</span>
                        </label>

                        <input type="file"
                            name="option_images[]"
                            accept="image/*"
                            class="w-full border rounded-lg p-2 mt-2">

                        <!-- TWK/TIU -->
                        <div class="correct-answer mt-3">
                            <label class="flex items-center gap-2">
                                <input type="radio"
                                    name="correct_answer"
                                    value="{{ $key }}"
                                    {{ old('correct_answer') == $key ? 'checked' : '' }}>
                                Jawaban Benar
                            </label>
                        </div>

                        <!-- TKP -->
                        <div class="score-input hidden mt-3">
                            <label>Skor TKP</label>
                            <input type="number" name="scores[]" value="{{ old('scores.' . $key) }}" min="1" max="5"
                                class="w-full border rounded-lg p-2 mt-2">
                        </div>

                    </div>

                @endforeach

            </div>

            <!-- Pembahasan -->
            <div>
                <label class="font-semibold">Pembahasan</label>

                <textarea name="explanation" rows="5" class="w-full border rounded-lg p-3 mt-2">{{ old('explanation') }}</textarea>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('questions.index') }}"
                    class="bg-red-500 text-white px-6 py-3 rounded-lg">
                    Kembali
                </a>
                <button class="bg-[#FF7A47] text-white px-6 py-3 rounded-lg">
                    Simpan Soal
                </button> 
            </div>

        </form>

    </main>

<script>
    const questionType = document.getElementById('questionType');
    const subCategory = document.getElementById('subCategory');

    const subCategories = {
        TWK: [
            'Nasionalisme',
            'Integritas',
            'Bela Negara',
            'Pilar Negara',
            'Bahasa Indonesia'
        ],
        TIU: [
            'Verbal',
            'Numerik',
            'Figural'
        ],
        TKP: [
            'Pelayanan Publik',
            'Jejaring Kerja',
            'Sosial Budaya',
            'Profesionalisme',
            'TIK',
            'Anti Radikalisme'
        ]
    };

    function updateSubCategory() {
        const selectedType = questionType.value;
        const oldSubCategory = "{{ old('sub_category') }}";

        subCategory.innerHTML = '';

        subCategories[selectedType].forEach(item => {
            const option = document.createElement('option');
            option.value = item;
            option.textContent = item;

            if (oldSubCategory === item) {
                option.selected = true;
            }

            subCategory.appendChild(option);
        });
    }

    function toggleInputs() {
        const isTKP = questionType.value === 'TKP';

        document.querySelectorAll('.score-input').forEach(el => {
            el.classList.toggle('hidden', !isTKP);
        });

        document.querySelectorAll('.correct-answer').forEach(el => {
            el.classList.toggle('hidden', isTKP);
        });

        updateSubCategory();
    }

    questionType.addEventListener('change', toggleInputs);

    toggleInputs();
</script>

</body>
</html>