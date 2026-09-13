<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->integer('appointment_id')->autoIncrement()->primary();
            $table->integer('student_id');
            $table->integer('consultant_id');
            $table->integer('application_id')->nullable();
            $table->date('appointment_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->enum('appointment_type', ["Online", "Physical", "Phone"])->nullable()->default('Online');
            $table->string('meeting_link', 500)->nullable();
            $table->enum('appointment_status', ["Requested", "Confirmed", "Completed", "Cancelled", "No Show"])->nullable()->default('Requested');
            $table->text('student_notes')->nullable();
            $table->text('consultant_notes')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
            $table->foreign('student_id', 'fk_appointments_student')->references('student_id')->on('students')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('consultant_id', 'fk_appointments_consultant')->references('consultant_id')->on('consultants')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('application_id', 'fk_appointments_application')->references('application_id')->on('applications')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
