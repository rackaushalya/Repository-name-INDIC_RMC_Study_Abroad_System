<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_preferences', function (Blueprint $table) {
            $table->integer('preference_id')->autoIncrement()->primary();
            $table->integer('student_id')->unique();
            $table->integer('preferred_country_id')->nullable();
            $table->string('preferred_course_field', 255)->nullable();
            $table->enum('preferred_course_level', ["Certificate", "Diploma", "Bachelor", "Master", "PhD"])->nullable();
            $table->string('preferred_intake', 100)->nullable();
            $table->decimal('min_budget', 12, 2)->nullable();
            $table->decimal('max_budget', 12, 2)->nullable();
            $table->enum('preferred_study_mode', ["On Campus", "Online", "Hybrid"])->nullable();
            $table->string('preferred_duration', 100)->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
            $table->foreign('student_id', 'fk_preferences_student')->references('student_id')->on('students')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('preferred_country_id', 'fk_preferences_country')->references('country_id')->on('countries')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_preferences');
    }
};
