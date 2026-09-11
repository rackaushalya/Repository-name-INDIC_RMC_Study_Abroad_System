<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scholarships', function (Blueprint $table) {
            $table->integer('scholarship_id')->autoIncrement()->primary();
            $table->integer('university_id')->nullable();
            $table->integer('course_id')->nullable();
            $table->string('scholarship_name', 255);
            $table->text('description')->nullable();
            $table->decimal('amount', 12, 2)->nullable();
            $table->decimal('percentage', 5, 2)->nullable();
            $table->text('eligibility')->nullable();
            $table->date('application_deadline')->nullable();
            $table->boolean('is_active')->nullable()->default(true);
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
            $table->foreign('university_id', 'fk_scholarships_university')->references('university_id')->on('universities')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('course_id', 'fk_scholarships_course')->references('course_id')->on('courses')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scholarships');
    }
};
