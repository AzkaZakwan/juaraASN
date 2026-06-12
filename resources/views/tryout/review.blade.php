<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Review Try Out</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-[#FFF9F5] text-gray-800" style="font-family: 'Poppins', sans-serif;">

@include('components.sidebar')
@include('components.navbar')

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
            <div class="bg-white rounded-3xl p-6 sm:p-8 card-shadow border border-[#FF7A47] min-h-[220px]">

                <div class="border-b border-slate-200 pb-4 mb-6">
                    <h2 id="reviewQuestionNumber" class="text-lg sm:text-xl font-bold text-slate-800">
                        Soal No 1
                    </h2>
                </div>

                <div class="text-sm sm:text-base text-slate-700 leading-relaxed mb-6 sm:mb-8 text-justify font-medium">
                    <div id="reviewQuestionText" class="bg-white rounded-2xl border-2 border-[#FF7A47] p-6 min-h-[120px]">
                    </div>
                </div>

                <div id="reviewOptionsContainer" class="border-t border-slate-100 pt-6 space-y-4"></div>

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
        <div class="bg-white rounded-3xl p-4 sm:p-6 card-shadow border border-[#FF7A47] w-full">

            <div class="flex flex-wrap gap-1 mb-6">
                @foreach ($questions as $index => $question)
                    <button
                        type="button"
                        data-index="{{ $index }}"
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

<script>
    const questions = window.reviewQuestions;
    const answers = window.reviewAnswers;
    let currentIndex = 0;

    function renderReview(index) {
        currentIndex = index;

        const q = questions[index];
        const answer = answers[q.id] ?? null;
        const userOptionId = answer ? Number(answer.option_id) : null;

        document.getElementById('reviewQuestionNumber').innerText = `Soal No ${index + 1}`;
        let questionHtml = `<div>${q.question_text}</div>`;
        if (q.question_image) {
            questionHtml += `
                <div class="mt-4 flex justify-center">
                    <img src="/storage/${q.question_image}"
                        class="max-w-full max-h-[400px] object-contain rounded-xl border">
                </div>
            `;
        }

        document.getElementById('reviewQuestionText').innerHTML = questionHtml;
        document.getElementById('reviewExplanation').innerHTML = q.explanation ?? 'Belum ada pembahasan.';

        let html = '';

        q.options.forEach(option => {
            const isUserAnswer = userOptionId === Number(option.id);
            const isCorrect = Number(option.is_correct) === 1;
            const isTkp = q.question_type === 'TKP';

            let textColor = 'text-gray-700';
            let borderColor = 'border-gray-300';
            let dotColor = 'bg-gray-300';
            let badge = '';

            if (isCorrect && !isTkp) {
                textColor = 'text-green-600';
                borderColor = 'border-green-500';
                dotColor = 'bg-green-500';
                badge = '<span class="ml-2 text-xs bg-green-100 text-green-700 px-2 py-1 rounded-lg font-bold">Benar</span>';
            }

            if (isUserAnswer && !isCorrect && !isTkp) {
                textColor = 'text-red-500';
                borderColor = 'border-red-500';
                dotColor = 'bg-red-500';
                badge = '<span class="ml-2 text-xs bg-red-100 text-red-700 px-2 py-1 rounded-lg font-bold">Jawaban Anda</span>';
            }

            if (isUserAnswer && isCorrect && !isTkp) {
                badge = '<span class="ml-2 text-xs bg-green-100 text-green-700 px-2 py-1 rounded-lg font-bold">Jawaban Anda Benar</span>';
            }
            let scoreBadge = '';

            if (isTkp) {
                scoreBadge = `
                    <span class="ml-2 text-xs bg-green-100 text-green-700 px-2 py-1 rounded-lg font-bold">
                        ${option.score} Poin
                    </span>
                `;
            }
            if (isUserAnswer && isTkp) {
                textColor = 'text-green-600';
                borderColor = 'border-green-500';
                dotColor = 'bg-green-500';
                badge = '<span class="ml-2 text-xs bg-green-100 text-green-700 px-2 py-1 rounded-lg font-bold">Jawaban Anda</span>';
            }

            html += `
                <div class="flex items-center gap-3 font-medium ${textColor}">
                    <span class="w-5 h-5 rounded-full border-2 flex items-center justify-center ${borderColor}">
                        ${isUserAnswer ? `<span class="w-2.5 h-2.5 rounded-full ${dotColor}"></span>` : ''}
                    </span>

                    <span>
                        ${option.option_label}. ${option.option_text}
                        ${badge}
                        ${scoreBadge}

                        ${option.option_image ? `
                            <div class="mt-2">
                                <img src="/storage/${option.option_image}"
                                    class="max-w-[220px] max-h-[180px] object-contain rounded-lg border">
                            </div>
                        ` : ''}
                    </span>
                </div>
            `;
        });

        document.getElementById('reviewOptionsContainer').innerHTML = html;
        updateReviewButtons();
    }

    function isQuestionWrong(q) {
        const answer = answers[q.id] ?? null;

        if (!answer) {
            return true;
        }

        const selectedOption = q.options.find(
            option => Number(option.id) === Number(answer.option_id)
        );

        if (!selectedOption) {
            return true;
        }

        // TKP tidak ada benar/salah, jadi tidak dianggap salah
        if (q.question_type === 'TKP') {
            return false;
        }

        return Number(selectedOption.is_correct) !== 1;
    }

    function updateReviewButtons() {
        document.querySelectorAll('.review-btn').forEach((btn, index) => {
            const q = questions[index];
            const wrong = isQuestionWrong(q);

            btn.className = 'review-btn w-9 h-9 md:w-10 md:h-10 flex-shrink-0 flex items-center justify-center text-xs font-bold border-2 rounded-lg transition-all duration-200 hover:scale-105';

            if (index === currentIndex) {
                btn.classList.add('bg-[#FF8B60]', 'border-[#FF8B60]', 'text-white');
            } else if (wrong) {
                btn.classList.add('bg-white', 'border-red-500', 'text-red-500');
            } else {
                btn.classList.add('bg-white', 'border-green-500', 'text-green-600');
            }
        });
    }

    document.querySelectorAll('.review-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            renderReview(Number(this.dataset.index));
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        renderReview(0);
    });
</script>

</body>
</html>