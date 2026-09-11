<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_requirements', function (Blueprint $table) {
            $table->integer('requirement_id')->autoIncrement()->primary();
            $table->integer('course_id')->unique();
            $table->decimal('minimum_gpa', 4, 2)->nullable();
            $table->integer('minimum_age')->nullable();
            $table->integer('maximum_age')->nullable();
            $table->integer('minimum_work_experience_months')->nullable()->default(0);
            $table->enum('required_qualification_level', ["O_Level", "A_Level", "Certificate", "Diploma", "HND", "Bachelor", "Master", "PhD"])->nullable();
            $table->string('required_field', 255)->nullable();
            $table->text('other_requirements')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
            $table->foreign('course_id', 'fk_requirements_course')->references('course_id')->on('courses')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_requirements');
    }
};
