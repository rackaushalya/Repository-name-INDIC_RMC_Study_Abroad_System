<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('academic_qualifications', function (Blueprint $table) {
            $table->integer('qualification_id')->autoIncrement()->primary();
            $table->integer('student_id');
            $table->enum('qualification_type', ["O_Level", "A_Level", "Certificate", "Diploma", "HND", "Bachelor", "Master", "PhD", "Other"]);
            $table->string('institution_name', 255)->nullable();
            $table->string('qualification_name', 255)->nullable();
            $table->string('field_of_study', 255)->nullable();
            $table->date('start_date')->nullable();
            $table->date('completion_date')->nullable();
            $table->string('grade', 50)->nullable();
            $table->decimal('gpa', 4, 2)->nullable();
            $table->text('description')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
            $table->foreign('student_id', 'fk_academic_student')->references('student_id')->on('students')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('academic_qualifications');
    }
};
