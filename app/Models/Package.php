<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
    'name',
    'description',
    'image',
    'price',
    'is_active',
    'is_premium',
    'show_explanation',
    'duration_minutes'
    ];

    public function questions()
    {
        return $this->belongsToMany(
            QuestionBank::class,
            'package_questions',
            'package_id',
            'question_id'
        );
    }
    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'user_packages'
        )->withTimestamps();
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    public function attempts()
    {
        return $this->hasMany(Attempt::class);
    }
}