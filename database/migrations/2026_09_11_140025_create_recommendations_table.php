<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recommendations', function (Blueprint $table) {
            $table->integer('recommendation_id')->autoIncrement()->primary();
            $table->integer('student_id');
            $table->integer('application_id')->nullable();
            $table->integer('course_id');
            $table->decimal('match_percentage', 5, 2);
            $table->boolean('qualification_match')->nullable()->default(false);
            $table->boolean('english_match')->nullable()->default(false);
            $table->boolean('budget_match')->nullable()->default(false);
            $table->boolean('preference_match')->nullable()->default(false);
            $table->boolean('work_experience_match')->nullable()->default(false);
            $table->text('recommendation_reason')->nullable();
            $table->enum('recommendation_status', ["Recommended", "Viewed", "Selected", "Rejected"])->nullable()->default('Recommended');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->foreign('student_id', 'fk_recommendations_student')->references('student_id')->on('students')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('application_id', 'fk_recommendations_application')->references('application_id')->on('applications')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('course_id', 'fk_recommendations_course')->references('course_id')->on('courses')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recommendations');
    }
};
