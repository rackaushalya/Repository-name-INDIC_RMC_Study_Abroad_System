<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('scholarships', function (Blueprint $table) {
            $table->string('scholarship_code', 50)->nullable()->unique()->after('course_id');
            $table->string('coverage_type', 30)->nullable()->after('scholarship_name');
            $table->string('award_value', 255)->nullable()->after('coverage_type');
            $table->string('degree_level', 50)->nullable()->after('award_value');
            $table->string('field_of_study', 150)->nullable()->after('degree_level');
            $table->string('min_gpa', 100)->nullable()->after('field_of_study');
            $table->string('quota', 150)->nullable()->after('min_gpa');
            $table->string('category', 100)->nullable()->after('quota');
        });
    }

    public function down(): void
    {
        Schema::table('scholarships', function (Blueprint $table) {
            $table->dropUnique(['scholarship_code']);
            $table->dropColumn([
                'scholarship_code',
                'coverage_type',
                'award_value',
                'degree_level',
                'field_of_study',
                'min_gpa',
                'quota',
                'category',
            ]);
        });
    }
};
