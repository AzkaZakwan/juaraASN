<?php

namespace App\Imports;

use App\Models\QuestionBank;
use App\Models\QuestionOption;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class QuestionsImport implements ToCollection
{
    public array $questionIds = [];

    public function collection(Collection $rows)
    {
        $rows->shift();

        foreach ($rows as $row) {
            if (empty($row[0]) || empty($row[1])) {
                continue;
            }

            $type = strtoupper(trim($row[0]));

            if (!in_array($type, ['TWK', 'TIU', 'TKP'])) {
                continue;
            }

            $question = QuestionBank::create([
                'question_type' => $type,
                'sub_category' => null,
                'question_text' => $row[1],
                'explanation' => $row[13] ?? null,
            ]);

            $this->questionIds[] = $question->id;

            $options = [
                'A' => ['text' => $row[2] ?? null,  'score' => $row[3] ?? null],
                'B' => ['text' => $row[4] ?? null,  'score' => $row[5] ?? null],
                'C' => ['text' => $row[6] ?? null,  'score' => $row[7] ?? null],
                'D' => ['text' => $row[8] ?? null,  'score' => $row[9] ?? null],
                'E' => ['text' => $row[10] ?? null, 'score' => $row[11] ?? null],
            ];

            $correctOption = strtoupper(trim($row[12] ?? ''));

            foreach ($options as $label => $option) {
                if ($type === 'TKP') {
                    $isCorrect = false;
                    $score = (int) $option['score'];
                } else {
                    $isCorrect = $correctOption === $label;
                    $score = $isCorrect ? 5 : 0;
                }

                QuestionOption::create([
                    'question_id' => $question->id,
                    'option_label' => $label,
                    'option_text' => $option['text'],
                    'is_correct' => $isCorrect,
                    'score' => $score,
                ]);
            }
        }
    }
}