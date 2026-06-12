<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuestionBank;
use App\Models\QuestionOption;
use Illuminate\Support\Facades\DB;
use App\Imports\QuestionsImport;
use Maatwebsite\Excel\Facades\Excel;

class QuestionBankController extends Controller
{

    public function index()
    {
        $questions = QuestionBank::latest()->get();
        return view('admin.questions.index', compact('questions'));
    }

    public function create()
    {
        return view('admin.questions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question_text' => 'required',
            'question_type' => 'required|in:TWK,TIU,TKP',
            'sub_category' => 'required',
            'question_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
            'option_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
            'options' => 'required|array|min:5',
            'options.*' => 'required',
            'explanation' => 'nullable',
        ]);

        if ($request->question_type === 'TKP') {
            $scores = $request->scores ?? [];

            if (count($scores) !== 5 || count(array_unique($scores)) !== 5) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'scores' => 'Tidak boleh ada skor yang sama untuk soal TKP',
                    ]);
            }
        }

        if ($request->question_type !== 'TKP' && $request->correct_answer === null) {
            return back()
                ->withInput()
                ->withErrors([
                    'correct_answer' => 'Jawaban benar wajib dipilih untuk soal TWK/TIU.',
                ]);
        }

        $questionImagePath = null;

        if ($request->hasFile('question_image')) {
            $questionImagePath = $request->file('question_image')
                ->store('questions', 'public');
        }

        $question = QuestionBank::create([
            'question_text' => $request->question_text,
            'question_type' => $request->question_type,
            'sub_category' => $request->sub_category,
            'question_image' => $questionImagePath,
            'explanation' => $request->explanation,
        ]);

        foreach ($request->options as $key => $option) {

            $optionImagePath = null;

            if ($request->hasFile("option_images.$key")) {
                $optionImagePath = $request->file("option_images.$key")
                    ->store('question_options', 'public');
            }

            if ($request->question_type === 'TKP') {
                $isCorrect = false;
                $score = $request->scores[$key];
            } else {
                $isCorrect = $request->correct_answer == $key;
                $score = $isCorrect ? 5 : 0;
            }

            QuestionOption::create([
                'question_id' => $question->id,
                'option_label' => chr(65 + $key),
                'option_text' => $option,
                'option_image' => $optionImagePath,
                'is_correct' => $isCorrect,
                'score' => $score,
            ]);
        }

        return redirect()->route('questions.index')
            ->with('success', 'Soal berhasil ditambahkan');
    }
    
    public function show(string $id)
    {
        //
    }

    public function edit(QuestionBank $question)
    {
        $question->load('options');
        if ($question->answers()->exists()) {
            return redirect()
                ->route('questions.index')
                ->with('error', 'Soal ini sudah pernah dikerjakan user sehingga tidak dapat diedit');
        }

        return view('admin.questions.edit', compact('question'));
    }

    public function update(Request $request, QuestionBank $question)
    {
        $request->validate([
            'question_text' => 'required',
            'question_type' => 'required|in:TWK,TIU,TKP',
            'sub_category' => 'required',
            'question_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
            'option_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
            'options' => 'required|array|min:5',
            'options.*' => 'required',
            'explanation' => 'nullable',
        ]);

        if ($request->question_type === 'TKP') {
            $scores = $request->scores ?? [];

            if (count($scores) !== 5 || count(array_unique($scores)) !== 5) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'scores' => 'Skor TKP harus lengkap dan tidak boleh ada nilai yang sama. Gunakan skor 1, 2, 3, 4, 5.',
                    ]);
            }
        }

        if ($request->question_type !== 'TKP' && $request->correct_answer === null) {
            return back()
                ->withInput()
                ->withErrors([
                    'correct_answer' => 'Jawaban benar wajib dipilih untuk soal TWK/TIU.',
                ]);
        }

        $questionImagePath = $question->question_image;
        if ($request->hasFile('question_image')) {
            $questionImagePath = $request->file('question_image')
                ->store('questions', 'public');
        }

        $question->update([
            'question_text' => $request->question_text,
            'question_type' => $request->question_type,
            'sub_category' => $request->sub_category,
            'question_image' => $questionImagePath,
            'explanation' => $request->explanation,
        ]);

        foreach ($question->options as $key => $option) {
            $optionImagePath = $option->option_image;
            if ($request->hasFile("option_images.$key")) {
                $optionImagePath = $request->file("option_images.$key")
                    ->store('question_options', 'public');
            }

            if ($request->question_type === 'TKP') {
                $isCorrect = false;
                $score = $request->scores[$key];
            } else {
                $isCorrect = $request->correct_answer == $key;
                $score = $isCorrect ? 5 : 0;
            }

            $option->update([
                'option_text' => $request->options[$key],
                'option_image' => $optionImagePath,
                'is_correct' => $isCorrect,
                'score' => $score,
            ]);
        }

        if ($question->answers()->exists()) {
            return redirect()
                ->route('questions.index')
                ->with('error', 'Soal ini sudah pernah dikerjakan user sehingga tidak dapat diperbarui');
        }

        return redirect()->route('questions.index')
            ->with('success', 'Soal berhasil diperbarui');
    }

    public function destroy(QuestionBank $question)
    {
        $question->delete();
        if ($question->answers()->exists()) {
            return back()
                ->with('error', 'Soal ini sudah pernah dikerjakan user sehingga tidak dapat dihapus');
        }
        return back();
    }
    
}
