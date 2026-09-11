<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->integer('application_id')->autoIncrement()->primary();
            $table->integer('student_id');
            $table->integer('preferred_country_id')->nullable();
            $table->integer('preferred_course_id')->nullable();
            $table->integer('preferred_intake_id')->nullable();
            $table->string('application_reference', 50)->unique();
            $table->enum('application_type', ["Consultation Request", "Study Abroad Guidance", "General Request"])->nullable()->default('Consultation Request');
            $table->enum('application_status', ["Submitted", "Under Review", "Consultant Assigned", "Consultation Scheduled", "Consultation Completed", "Recommendation Provided", "Follow-up Required", "Completed", "Rejected", "Cancelled"])->nullable()->default('Submitted');
            $table->text('student_message')->nullable();
            $table->timestamp('submitted_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
            $table->foreign('student_id', 'fk_applications_student')->references('student_id')->on('students')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('preferred_country_id', 'fk_applications_country')->references('country_id')->on('countries')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('preferred_course_id', 'fk_applications_course')->references('course_id')->on('courses')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('preferred_intake_id', 'fk_applications_intake')->references('intake_id')->on('course_intakes')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
