<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'attempt_id',
        'question_id',
        'option_id',
        'selected_score',
    ];

    public function question()
    {
        return $this->belongsTo(QuestionBank::class, 'question_id');
    }

    public function option()
    {
        return $this->belongsTo(QuestionOption::class, 'option_id');
    }

    public function attempt()
    {
        return $this->belongsTo(Attempt::class);
    }
}
