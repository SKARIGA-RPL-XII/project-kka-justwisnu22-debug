<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('level_id')->constrained('category_levels')->onDelete('cascade');
            $table->enum('status', ['locked', 'ongoing', 'completed'])->default('locked');
            $table->timestamps();
            
            // Unique constraint: one progress record per user per level
            $table->unique(['user_id', 'level_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_progress');
    }
};
