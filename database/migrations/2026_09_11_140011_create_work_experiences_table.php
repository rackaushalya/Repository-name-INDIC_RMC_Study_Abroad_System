<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('work_experiences', function (Blueprint $table) {
            $table->integer('work_experience_id')->autoIncrement()->primary();
            $table->integer('student_id');
            $table->string('company_name', 255);
            $table->string('job_title', 255)->nullable();
            $table->enum('employment_type', ["Full Time", "Part Time", "Internship", "Contract", "Other"])->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('is_current')->nullable()->default(false);
            $table->text('description')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
            $table->foreign('student_id', 'fk_work_student')->references('student_id')->on('students')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('work_experiences');
    }
};
