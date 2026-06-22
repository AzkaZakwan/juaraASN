<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulasi Try Out - raihASN</title>
    <script>
        window.durationMinutes = {{ $attempt->package->duration_minutes ?? 100 }};
        window.startedAt = "{{ $attempt->started_at->toIso8601String() }}";
        window.finishedAt = "{{ $attempt->finished_at }}";
        window.questions = @json($questions);
        window.savedAnswers = @json($answers);
        window.attemptId = {{ $attempt->id }};
        window.saveAnswerUrl = "{{ route('tryout.saveAnswer') }}";
        window.submitUrl = "{{ route('tryout.submit', $attempt->id) }}";
        window.csrfToken = "{{ csrf_token() }}";
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .card-shadow {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }
    </style>
    <link rel="icon" type="image/png" href="{{ asset('images/juaraASNco.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class=" antialiased text-slate-800" style="font-family: 'Poppins', sans-serif;">

    {{-- Main --}}
    <main class="max-w-7xl mx-auto px-3 sm:px-5 lg:px-6 mt-4 pt-20">

        <div class="mb-8">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900">{{ $attempt->package->name }}</h1>
            <p class="text-slate-500 font-medium">Kerjakan soal dengan jujur dan sungguh-sungguh</p>

            <div id="timer"
                class="mt-5 inline-block bg-[#FF8B60] text-white px-4 sm:px-6 py-2 rounded-full text-lg sm:text-2xl font-black shadow-lg">
                00:00:00
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-[1.3fr_0.9fr] gap-5 lg:gap-8 items-start mt-6">
                <div class="bg-white rounded-3xl p-4 sm:p-6 lg:p-8 card-shadow">
                    <div class="border-b border-slate-200 pb-4 mb-6">
                        <h2 id="judulSoal" class="text-lg sm:text-xl font-bold text-slate-800">
                            Soal No 1
                        </h2>
                    </div>

                    <div id="questionText"
                        class="text-sm sm:text-base text-slate-700 leading-relaxedmb-6 sm:mb-8 text-justify font-medium">
                    </div>

                    <div class="border-t border-slate-100 pt-6 space-y-4">
                        <div id="optionsContainer"></div>
                    </div>

                    <div class="mt-8 flex gap-3">
                        <button id="btnPrev"
                            class="text-[#FFA35C] border-2 border-[#FFA35C] px-5 sm:px-8 py-2.5 sm:py-3 text-sm sm:text-base rounded-2xl ">
                            Sebelumnya
                        </button>

                        <button id="btnNext"
                            class="bg-[#FFA35C] text-white px-5 sm:px-8 py-2.5 sm:py-3 text-sm sm:text-base rounded-2xl">
                            Selanjutnya
                        </button>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-4 sm:p-6 card-shadow ">
                    <div class="text-center mb-6">
                        <span class="inline-block w-3/4 text-[#000] font-bold border-b border-[#5e5c5c]/50 pb-2 px-4">Nomor Soal</span>
                    </div>

                    <div class="flex flex-wrap gap-1 mb-6">
                        @for ($i = 1; $i <= $questions->count(); $i++)
                            <button
                                class="soal-btn w-9 h-9 md:w-10 md:h-10 flex-shrink-0 flex items-center justify-center text-xs font-bold border rounded-lg transition-all duration-200 hover:scale-105 bg-white border-[#FF8B60] text-[#FF8B60]"
                                data-question-id="{{ $questions[$i - 1]->id }}">
                                {{ $i }}
                            </button>
                        @endfor
                    </div>

                    <div class="space-y-3">
                        <button id="btnSelesai"
                            class="w-full bg-[#6FD8CA] text-white py-3 sm:py-4 rounded-2xl font-black text-sm sm:text-lg shadow-lg hover:scale-[1.02] transition active:scale-95">
                            Selesai
                        </button>

                        <button id="btnBatal"
                            class="w-full bg-[#FFA35C] text-white py-3 sm:py-4 rounded-2xl font-black text-sm sm:text-lg shadow-lg hover:scale-[1.02] transition active:scale-95">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- OVERLAY SELESAI -->
    <div id="overlaySelesai" class="fixed inset-0 bg-black/40 z-[999] hidden items-center justify-center px-4">

        <!-- POPUP -->
        <div id="popupSelesai"
            class="bg-white w-full max-w-md rounded-3xl p-5 sm:p-8 text-center shadow-2xl
        scale-95 opacity-0 transition-all duration-300">

            <!-- ICON -->
            <div class="w-24 h-24 bg-green-100 mx-auto rounded-full flex items-center justify-center mb-6">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-green-500" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />

                </svg>

            </div>

            <!-- TITLE -->
            <h2 class="text-xl sm:text-2xl font-bold mb-3">
                Selesai Mengerjakan?
            </h2>

            <!-- TEXT -->
            <p class="text-sm sm:text-base text-gray-500 mb-6 sm:mb-8">
                Pastikan semua jawaban telah diisi sebelum dikumpul
            </p>

            <!-- BUTTON -->
            <div class="flex gap-4">

                <!-- BATAL -->
                <button id="closeSelesai"
                    class="flex-1 border border-gray-300 py-3 rounded-xl font-semibold hover:bg-gray-100 transition">

                    Batal

                </button>

                <!-- SELESAI -->
                <button id="confirmSelesai"
                    class="flex-1 bg-[#FF7A47] text-white py-3 rounded-xl font-semibold hover:bg-[#f06a37] transition">
                    Selesai
                </button>

            </div>

        </div>
    </div>
    <!-- OVERLAY BATAL -->
    <div id="overlayBatal" class="fixed inset-0 bg-black/40 z-[999] hidden items-center justify-center px-4">

        <!-- POPUP -->
        <div id="popupBatal"
            class="bg-white w-full max-w-md rounded-3xl p-5 sm:p-8 text-center shadow-2xl
        scale-95 opacity-0 transition-all duration-300">

            <!-- ICON -->
            <div class="w-24 h-24 bg-red-100 mx-auto rounded-full flex items-center justify-center mb-6">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-red-500" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />

                </svg>

            </div>

            <!-- TITLE -->
            <h2 class="text-xl sm:text-2xl font-bold mb-3">
                Tinggalkan Sesi?
            </h2>

            <!-- TEXT -->
            <p class="text-sm sm:text-base text-gray-500 mb-6 sm:mb-8">
                Semua jawaban tidak akan tersimpan dan anda harus mengulang dari awal
            </p>

            <!-- BUTTON -->
            <div class="flex gap-4">

                <!-- KEMBALI -->
                <button id="closeBatal"
                    class="flex-1 border border-gray-300 py-3 rounded-xl font-semibold hover:bg-gray-100 transition">

                    Batal

                </button>

                <!-- TINGGALKAN -->
                <form action="{{ route('tryout.cancel', $attempt->id) }}" method="POST" class="flex-1">
                    @csrf
                    <button id="btnTinggalkan" type="submit"
                        class="w-full bg-red-500 text-white py-3 rounded-xl font-semibold hover:bg-red-600 transition">
                        Tinggalkan
                    </button>
                </form>

            </div>

        </div>
    </div>
</body>

</html>
