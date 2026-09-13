<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->integer('course_id')->autoIncrement()->primary();
            $table->integer('university_id');
            $table->string('course_name', 255);
            $table->enum('course_level', ["Certificate", "Diploma", "Bachelor", "Master", "PhD"]);
            $table->string('field_of_study', 150)->nullable();
            $table->string('duration', 100)->nullable();
            $table->enum('study_mode', ["On Campus", "Online", "Hybrid"])->nullable()->default('On Campus');
            $table->text('description')->nullable();
            $table->boolean('is_active')->nullable()->default(true);
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
            $table->foreign('university_id', 'fk_courses_university')->references('university_id')->on('universities')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
