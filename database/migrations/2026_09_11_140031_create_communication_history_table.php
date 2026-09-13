<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('communication_history', function (Blueprint $table) {
            $table->integer('communication_id')->autoIncrement()->primary();
            $table->integer('inquiry_id')->nullable();
            $table->integer('application_id')->nullable();
            $table->integer('student_id')->nullable();
            $table->integer('lead_id')->nullable();
            $table->integer('consultant_id')->nullable();
            $table->integer('sender_user_id');
            $table->enum('communication_type', ["Message", "Email", "Phone", "Note"]);
            $table->string('subject', 255)->nullable();
            $table->text('message');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->foreign('inquiry_id', 'fk_communication_inquiry')->references('inquiry_id')->on('inquiries')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('application_id', 'fk_communication_application')->references('application_id')->on('applications')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('student_id', 'fk_communication_student')->references('student_id')->on('students')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('lead_id', 'fk_communication_lead')->references('lead_id')->on('leads')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('consultant_id', 'fk_communication_consultant')->references('consultant_id')->on('consultants')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('sender_user_id', 'fk_communication_sender')->references('user_id')->on('users')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('communication_history');
    }
};
