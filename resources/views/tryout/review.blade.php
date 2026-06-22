<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Review Try Out</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="{{ asset('images/juaraASNco.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-[#FFF9F5] text-gray-800" style="font-family: 'Poppins', sans-serif;">

    @include('components.sidebar')
    @include('components.navbar')

    <div id="overlay" class="fixed inset-0 bg-black/40 z-40 hidden opacity-0 transition-opacity duration-300">
    </div>

    {{-- @php
    $answers = $attempt->answers;
    $current = $answers->first();
@endphp --}}

    <script>
        window.reviewQuestions = @json($questions);
        window.reviewAnswers = @json($answers);
    </script>

    <main class="max-w-7xl mx-auto px-3 sm:px-5 lg:px-6 mt-4 pt-20 pb-40">

        <h1 class="text-3xl font-extrabold text-gray-900">
            {{ $attempt->package->name }}
        </h1>
        <p class="text-gray-600 mb-10">
            Review jawaban dan pembahasan
        </p>

        <div class="grid grid-cols-1 xl:grid-cols-[1.3fr_0.9fr] gap-5 lg:gap-8 items-start mt-6">

            {{-- SOAL + PEMBAHASAN --}}
            <div class="space-y-5">
                <div class="bg-white rounded-3xl p-6 sm:p-8 card-shadow border   min-h-[220px]">

                    <div class="border-b border-slate-200 pb-4 mb-6">
                        <h2 id="reviewQuestionNumber" class="text-lg sm:text-xl font-bold text-slate-800">
                            Soal No 1
                        </h2>
                    </div>

                    <div id="reviewQuestionText" class="text-sm sm:text-base text-slate-700 leading-relaxedmb-6 sm:mb-8 text-justify font-medium">
                        </id=>
                    </div>

                    <div id="reviewOptionsContainer" class="border-t border-slate-100 pt-6 space-y-4"></div>

                    <div class="mt-8 flex gap-3">
                        <button id="reviewbtnPrev"
                            class="text-[#FFA35C] border-2 border-[#FFA35C] px-5 sm:px-8 py-2.5 sm:py-3 text-sm sm:text-base rounded-2xl ">
                            Sebelumnya
                        </button>

                        <button id="reviewbtnNext"
                            class="bg-[#FFA35C] text-white px-5 sm:px-8 py-2.5 sm:py-3 text-sm sm:text-base rounded-2xl">
                            Selanjutnya
                        </button>
                    </div>


                </div>

                <div class="bg-white rounded-3xl p-6 sm:p-8 card-shadow border border-[#FF7A47] min-h-[220px]">

                    <h3 class="text-[#FF7A47] font-bold text-xl mb-3">
                        Pembahasan
                    </h3>

                    <div class="border-b border-slate-200 mb-4"></div>

                    <div id="reviewExplanation" class="text-gray-700 leading-relaxed pb-8">
                    </div>

                </div>

            </div>

            {{-- NOMOR SOAL --}}
            <div class="bg-white rounded-3xl p-4 sm:p-6 card-shadow ">
                <div class="text-center mb-6">
                    <span class="inline-block w-3/4 text-[#000] font-bold border-b border-[#5e5c5c]/50 pb-2 px-4">Nomor
                        Soal</span>
                </div>

                <div class="flex flex-wrap gap-1 mb-6">
                    @foreach ($questions as $index => $question)
                        <button type="button" data-index="{{ $index }}"
                            class="review-btn w-9 h-9 md:w-10 md:h-10 flex-shrink-0 flex items-center justify-center text-xs font-bold border rounded-lg transition-all duration-200 hover:scale-105">
                            {{ $index + 1 }}
                        </button>
                    @endforeach
                </div>

                <a href="{{ route('riwayat') }}"
                    class="block text-center w-full bg-[#FFA35C] text-white py-3 rounded-xl font-bold hover:bg-[#f06a37] transition">
                    Kembali
                </a>

            </div>

        </div>
        <div class="h-50"></div>
    </main>

</body>

</html>
