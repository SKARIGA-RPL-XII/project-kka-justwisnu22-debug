<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('materials', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->after('id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('level_id')->nullable()->after('category_id')->constrained('category_levels')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('materials', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['level_id']);
            $table->dropColumn(['category_id', 'level_id']);
        });
    }
};
