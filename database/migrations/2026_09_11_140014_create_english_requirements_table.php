<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('english_requirements', function (Blueprint $table) {
            $table->integer('english_requirement_id')->autoIncrement()->primary();
            $table->integer('course_id');
            $table->enum('test_type', ["IELTS", "PTE", "TOEFL", "Duolingo", "Cambridge", "Other"]);
            $table->decimal('minimum_overall_score', 4, 2)->nullable();
            $table->decimal('minimum_listening_score', 4, 2)->nullable();
            $table->decimal('minimum_reading_score', 4, 2)->nullable();
            $table->decimal('minimum_writing_score', 4, 2)->nullable();
            $table->decimal('minimum_speaking_score', 4, 2)->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
            $table->foreign('course_id', 'fk_english_requirements_course')->references('course_id')->on('courses')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('english_requirements');
    }
};
