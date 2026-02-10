<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Check if foreign key exists before dropping
        $foreignKeys = DB::select("SELECT CONSTRAINT_NAME FROM information_schema.TABLE_CONSTRAINTS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'quizzes' AND CONSTRAINT_TYPE = 'FOREIGN KEY' AND CONSTRAINT_NAME = 'quizzes_category_id_foreign'");
        
        if (!empty($foreignKeys)) {
            Schema::table('quizzes', function (Blueprint $table) {
                $table->dropForeign(['category_id']);
            });
        }
        
        // Hapus data quiz yang referensi ke quiz_categories lama
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('quizzes')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        Schema::table('quizzes', function (Blueprint $table) {
            // Add level_id
            $table->foreignId('level_id')->nullable()->after('category_id')->constrained('category_levels')->onDelete('cascade');
            
            // Re-add category_id foreign key pointing to categories table
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('quizzes', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['level_id']);
            $table->dropColumn('level_id');
            
            // Restore old foreign key
            $table->foreign('category_id')->references('id')->on('quiz_categories')->onDelete('cascade');
        });
    }
};
