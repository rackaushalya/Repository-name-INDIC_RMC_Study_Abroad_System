<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inquiries', function (Blueprint $table) {
            $table->integer('inquiry_id')->autoIncrement()->primary();
            $table->integer('lead_id')->nullable();
            $table->integer('student_id')->nullable();
            $table->string('inquiry_subject', 255);
            $table->text('inquiry_message');
            $table->enum('inquiry_status', ["New", "In Progress", "Resolved", "Closed"])->nullable()->default('New');
            $table->integer('assigned_consultant_id')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
            $table->foreign('lead_id', 'fk_inquiries_lead')->references('lead_id')->on('leads')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('student_id', 'fk_inquiries_student')->references('student_id')->on('students')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('assigned_consultant_id', 'fk_inquiries_consultant')->references('consultant_id')->on('consultants')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
