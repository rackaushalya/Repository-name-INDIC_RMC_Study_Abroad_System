<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consultation_records', function (Blueprint $table) {
            $table->integer('consultation_record_id')->autoIncrement()->primary();
            $table->integer('appointment_id')->unique();
            $table->integer('consultant_id');
            $table->integer('student_id');
            $table->text('consultation_summary')->nullable();
            $table->text('consultation_notes')->nullable();
            $table->text('recommendations')->nullable();
            $table->text('next_action')->nullable();
            $table->enum('consultation_status', ["Completed", "Follow-up Required", "Closed"])->nullable()->default('Completed');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
            $table->foreign('appointment_id', 'fk_consultation_record_appointment')->references('appointment_id')->on('appointments')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('consultant_id', 'fk_consultation_record_consultant')->references('consultant_id')->on('consultants')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('student_id', 'fk_consultation_record_student')->references('student_id')->on('students')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consultation_records');
    }
};
