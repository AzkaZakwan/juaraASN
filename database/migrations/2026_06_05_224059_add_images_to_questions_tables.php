<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('question_banks', function (Blueprint $table) {
        $table->string('question_image')->nullable()->after('question_text');
        });

        Schema::table('question_options', function (Blueprint $table) {
            $table->string('option_image')->nullable()->after('option_text');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('question_banks', function (Blueprint $table) {
            $table->dropColumn('question_image');
        });

        Schema::table('question_options', function (Blueprint $table) {
            $table->dropColumn('option_image');
        });
    }
};
