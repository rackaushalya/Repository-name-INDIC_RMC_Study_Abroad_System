<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('english_qualifications', function (Blueprint $table) {
            $table->integer('english_qualification_id')->autoIncrement()->primary();
            $table->integer('student_id');
            $table->enum('test_type', ["IELTS", "PTE", "TOEFL", "Duolingo", "Cambridge", "Other"]);
            $table->decimal('overall_score', 4, 2)->nullable();
            $table->decimal('listening_score', 4, 2)->nullable();
            $table->decimal('reading_score', 4, 2)->nullable();
            $table->decimal('writing_score', 4, 2)->nullable();
            $table->decimal('speaking_score', 4, 2)->nullable();
            $table->date('test_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->string('certificate_number', 100)->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
            $table->foreign('student_id', 'fk_english_student')->references('student_id')->on('students')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('english_qualifications');
    }
};
