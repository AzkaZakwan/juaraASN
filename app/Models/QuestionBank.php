<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\QuestionOption;
use App\Models\Answer;

class QuestionBank extends Model
{
    protected $fillable = [
    'question_text',
    'question_type',
    'sub_category',
    'question_image',
    'explanation'
    ];
    public function options()
    {
        return $this->hasMany(QuestionOption::class, 'question_id');
    }

    public function packages()
    {
        return $this->belongsToMany(
            Package::class,
            'package_questions',
            'question_id',
            'package_id'
        );
        
    }
    public function answers()
    {
        return $this->hasMany(Answer::class, 'question_id');
    }
}
