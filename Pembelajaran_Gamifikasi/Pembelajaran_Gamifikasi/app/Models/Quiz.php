<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'exp_reward',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(QuizCategory::class, 'category_id');
    }

    public function questions()
    {
        return $this->hasMany(QuizQuestion::class);
    }

    public function results()
    {
        return $this->hasMany(UserQuizResult::class);
    }
}