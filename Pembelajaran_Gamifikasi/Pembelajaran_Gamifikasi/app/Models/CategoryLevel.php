<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryLevel extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'title', 'difficulty_id', 'order'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function difficulty()
    {
        return $this->belongsTo(Difficulty::class);
    }

    public function materials()
    {
        return $this->hasMany(Material::class, 'level_id');
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class, 'level_id');
    }

    public function userProgress()
    {
        return $this->hasMany(UserProgress::class, 'level_id');
    }
}
