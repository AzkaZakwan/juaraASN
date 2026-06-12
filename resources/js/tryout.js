document.addEventListener("DOMContentLoaded", () => {
    // let isSubmitting = false;
    // window.addEventListener("beforeunload", function (e) {
    //     if (!isSubmitting) {
    //         e.preventDefault();
    //         e.returnValue = "Jika keluar, tryout tetap berjalan dan waktu tidak berhenti.";
    //     }
    // });
    console.log("TRYOUT JS LOADED");
    console.log("questions =", window.questions);
    console.log("optionsContainer =", document.getElementById("optionsContainer"));
    const questions = window.questions;
    const savedAnswersRaw = window.savedAnswers || {};
    const savedAnswers = {};

    if (Array.isArray(savedAnswersRaw)) {
        savedAnswersRaw.forEach(ans => {
            savedAnswers[String(ans.question_id)] = ans;
        });
    } else if (typeof savedAnswersRaw === "object" && savedAnswersRaw !== null) {
        Object.values(savedAnswersRaw).forEach(ans => {
            savedAnswers[String(ans.question_id)] = ans;
        });
    }
    const attemptId = window.attemptId;
    const saveAnswerUrl = window.saveAnswerUrl;
    const csrfToken = window.csrfToken;
    
    /* TIMER SERVER BASED */
    const timerDisplay = document.getElementById("timer");

    function submitTryoutAuto() {
        // isSubmitting = true;
        fetch(window.submitUrl, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": window.csrfToken,
                "Accept": "application/json"
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                window.location.href = data.redirect;
            }
        })
        .catch(() => {
            alert("Waktu habis. Koneksi bermasalah, silakan refresh halaman.");
        });
    }

    if (timerDisplay) {
        const startedAt = new Date(window.startedAt).getTime();
        const durationMs = Number(window.durationMinutes) * 60 * 1000;
        const endTime = startedAt + durationMs;

        const timer = setInterval(() => {
            const remaining = Math.floor((endTime - Date.now()) / 1000);

            if (remaining <= 0) {
                clearInterval(timer);
                timerDisplay.textContent = "00:00:00";
                submitTryoutAuto();
                return;
            }

            let hours = Math.floor(remaining / 3600);
            let minutes = Math.floor((remaining % 3600) / 60);
            let seconds = remaining % 60;

            timerDisplay.textContent =
                `${String(hours).padStart(2, "0")}:${String(minutes).padStart(2, "0")}:${String(seconds).padStart(2, "0")}`;
        }, 1000);
    }

    // NOMOR SOAL
    
    const soalButtons = document.querySelectorAll(".soal-btn");
    const judulSoal = document.getElementById("judulSoal");
    const questionText = document.getElementById("questionText");
    const optionsContainer = document.getElementById("optionsContainer");

    if (soalButtons.length && judulSoal) {

        let currentSoal = 1
        renderQuestion(0);
        updateQuestionButtons();

        function renderQuestion(index) {
            const q = questions[index];

            if (!q) {
                questionText.innerHTML = "Soal tidak ditemukan";
                optionsContainer.innerHTML = "";
                return;
            }

            let questionHtml = `<div>${q.question_text}</div>`;
            if (q.question_image) {
                questionHtml += `
                    <div class="mt-4">
                        <img src="/storage/${q.question_image}" 
                            class="max-w-full max-h-[400px] object-contain rounded-xl border mx-auto"
                    </div>
                `;
            }

            questionText.innerHTML = questionHtml;

            let html = "";

            (q.options || []).forEach(option => {

                const checked =
                    Number(savedAnswers[q.id]?.option_id) === Number(option.id) ? "checked" : "";

                html += `
                    <label class="flex items-center gap-3 mb-4">
                        <input type="radio"
                            name="jawaban_${q.id}"
                            value="${option.id}"
                            data-question="${q.id}"
                            class="answer-radio"
                            ${checked}
                        >
                        <span>
                            ${option.option_text}

                            ${option.option_image ? `
                                <div class="mt-2">
                                    <img src="/storage/${option.option_image}" 
                                        class="max-w-[220px] max-h-[180px] object-contain rounded-lg border mt-2"
                                    >
                                </div>
                            ` : ''}
                        </span>
                    </label>
                `;
            });

            optionsContainer.innerHTML = html;
        }
        
        function updateQuestionButtons() {

            soalButtons.forEach((btn) => {

                const questionId = String(btn.dataset.questionId);

                const isAnswered = savedAnswers[questionId]?.option_id;

                const currentQuestionId = String(questions[currentSoal - 1]?.id);
                const isActive = questionId === currentQuestionId;

                btn.className = `
                    w-9 h-9 md:w-10 md:h-10 flex-shrink-0 flex items-center justify-center text-xs font-bold border rounded-lg transition-all duration-200 hover:scale-105
                `;

                if (isActive) {
                    btn.classList.add("bg-[#FF8B60]", "border-[#FF8B60]", "text-white");
                }
                else if (isAnswered) {
                    btn.classList.add("bg-gray-500", "border-gray-500", "text-white");
                }
                else {
                    btn.classList.add("bg-white", "border-[#FF8B60]", "text-[#FF8B60]");
                }
            });
        }

        function setActiveSoal(nomor) {

            currentSoal = nomor

            judulSoal.textContent = `Soal No ${nomor}`
            renderQuestion(nomor - 1);
            updateQuestionButtons()
        }

        soalButtons.forEach((btn, index) => {

            btn.addEventListener("click", () => {
                const id = parseInt(btn.dataset.questionId);

                const index = questions.findIndex(q => q.id === id);

                setActiveSoal(index + 1);
            });

        })
        
        // NEXT PREV

        const btnNext = document.getElementById("btnNext")
        const btnPrev = document.getElementById("btnPrev")

        btnNext?.addEventListener("click", () => {

            if (currentSoal < soalButtons.length) {
                setActiveSoal(currentSoal + 1)
            }

        })

        btnPrev?.addEventListener("click", () => {

            if (currentSoal > 1) {
                setActiveSoal(currentSoal - 1)
            }

        })

        optionsContainer?.addEventListener("change", (e) => {

            if (!e.target.classList.contains("answer-radio")) return;

            const questionId = e.target.dataset.question;
            const optionId = e.target.value;

            savedAnswers[questionId] = {
                option_id: optionId
            };

            // FORCE DOM SYNC
            requestAnimationFrame(() => {
                updateQuestionButtons();
            });

            fetch(saveAnswerUrl, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken
                },
                body: JSON.stringify({
                    attempt_id: attemptId,
                    question_id: questionId,
                    option_id: optionId
                })
            });

        });

    }
    
    // OVERLAY SELESAI

    const btnSelesai = document.getElementById("btnSelesai")
    const overlaySelesai = document.getElementById("overlaySelesai")
    const popupSelesai = document.getElementById("popupSelesai")
    const closeSelesai = document.getElementById("closeSelesai")

    if (
        btnSelesai &&
        overlaySelesai &&
        popupSelesai &&
        closeSelesai
    ) {

        btnSelesai.addEventListener("click", () => {

            overlaySelesai.classList.remove("hidden")
            overlaySelesai.classList.add("flex")

            setTimeout(() => {

                popupSelesai.classList.remove(
                    "scale-95",
                    "opacity-0"
                )

                popupSelesai.classList.add(
                    "scale-100",
                    "opacity-100"
                )

            }, 10)

        })

        closeSelesai.addEventListener("click", () => {

            popupSelesai.classList.remove(
                "scale-100",
                "opacity-100"
            )

            popupSelesai.classList.add(
                "scale-95",
                "opacity-0"
            )

            setTimeout(() => {

                overlaySelesai.classList.add("hidden")
                overlaySelesai.classList.remove("flex")

            }, 200)

        })

    }

    const confirmSelesai = document.getElementById("confirmSelesai");
    
        confirmSelesai?.addEventListener("click", () => {
            // isSubmitting = true;
            fetch(window.submitUrl, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": window.csrfToken,
                    "Accept": "application/json"
                }
            })
            .then(async res => {
                const text = await res.text();
                console.log("SUBMIT STATUS:", res.status);
                console.log("SUBMIT RESPONSE:", text);

                if (!res.ok) {
                    throw new Error(text);
                }

                return JSON.parse(text);
            })
            .then(data => {
                if (data.success) {                    
                    window.location.href = data.redirect;
                } else {
                    alert("Submit gagal.");
                }
            })
            .catch(err => {
                console.error("SUBMIT ERROR:", err);
                alert("Gagal menyelesaikan tryout. Cek Console / Network.");
            });
        });

    // OVERLAY BATAL

    const btnBatal = document.getElementById("btnBatal")
    const overlayBatal = document.getElementById("overlayBatal")
    const popupBatal = document.getElementById("popupBatal")
    const closeBatal = document.getElementById("closeBatal")
    // const btnTinggalkan = document.getElementById("btnTinggalkan");
    // btnTinggalkan?.addEventListener("click", () => {
    //     isSubmitting = true;
    // });

    if (
        btnBatal &&
        overlayBatal &&
        popupBatal &&
        closeBatal
    ) {

        btnBatal.addEventListener("click", () => {

            overlayBatal.classList.remove("hidden")
            overlayBatal.classList.add("flex")

            setTimeout(() => {

                popupBatal.classList.remove(
                    "scale-95",
                    "opacity-0"
                )

                popupBatal.classList.add(
                    "scale-100",
                    "opacity-100"
                )

            }, 10)

        })

        closeBatal.addEventListener("click", () => {

            popupBatal.classList.remove(
                "scale-100",
                "opacity-100"
            )

            popupBatal.classList.add(
                "scale-95",
                "opacity-0"
            )

            setTimeout(() => {

                overlayBatal.classList.add("hidden")
                overlayBatal.classList.remove("flex")

            }, 200)

        })

    }
})

    