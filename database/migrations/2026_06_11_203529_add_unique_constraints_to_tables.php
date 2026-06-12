<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_packages', function (Blueprint $table) {
            $table->unique(['user_id', 'package_id']);
        });

        Schema::table('package_questions', function (Blueprint $table) {
            $table->unique(['package_id', 'question_id']);
        });

        Schema::table('question_options', function (Blueprint $table) {
            $table->unique(['question_id', 'option_label']);
        });
    }

    public function down(): void
    {
        Schema::table('user_packages', function (Blueprint $table) {
            $table->dropUnique(['user_id', 'package_id']);
        });

        Schema::table('package_questions', function (Blueprint $table) {
            $table->dropUnique(['package_id', 'question_id']);
        });

        Schema::table('question_options', function (Blueprint $table) {
            $table->dropUnique(['question_id', 'option_label']);
        });
    }
};
