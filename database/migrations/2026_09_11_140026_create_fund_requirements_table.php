<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fund_requirements', function (Blueprint $table) {
            $table->integer('fund_requirement_id')->autoIncrement()->primary();
            $table->integer('student_id');
            $table->integer('application_id')->nullable();
            $table->integer('selected_country_id')->nullable();
            $table->integer('selected_course_id')->nullable();
            $table->decimal('total_tuition', 12, 2)->nullable()->default(0);
            $table->decimal('total_living_cost', 12, 2)->nullable()->default(0);
            $table->decimal('total_travel_cost', 12, 2)->nullable()->default(0);
            $table->decimal('total_other_cost', 12, 2)->nullable()->default(0);
            $table->decimal('scholarship_amount', 12, 2)->nullable()->default(0);
            $table->decimal('total_required_amount', 12, 2)->nullable()->default(0);
            $table->string('currency', 10)->nullable()->default('LKR');
            $table->text('notes')->nullable();
            $table->integer('generated_by')->nullable();
            $table->timestamp('generated_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
            $table->foreign('student_id', 'fk_fund_student')->references('student_id')->on('students')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('application_id', 'fk_fund_application')->references('application_id')->on('applications')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('selected_country_id', 'fk_fund_country')->references('country_id')->on('countries')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('selected_course_id', 'fk_fund_course')->references('course_id')->on('courses')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('generated_by', 'fk_fund_generated_by')->references('user_id')->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fund_requirements');
    }
};
