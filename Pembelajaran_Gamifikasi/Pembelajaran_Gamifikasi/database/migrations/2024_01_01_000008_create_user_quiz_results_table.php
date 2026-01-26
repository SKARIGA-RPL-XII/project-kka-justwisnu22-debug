<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_quiz_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('quiz_id')->constrained('quizzes');
            $table->integer('score');
            $table->integer('earned_exp');
            $table->timestamp('completed_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_quiz_results');
    }
};