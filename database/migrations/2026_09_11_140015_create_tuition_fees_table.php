<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tuition_fees', function (Blueprint $table) {
            $table->integer('tuition_fee_id')->autoIncrement()->primary();
            $table->integer('course_id');
            $table->decimal('amount', 12, 2);
            $table->string('currency', 10);
            $table->enum('fee_period', ["Year", "Semester", "Course", "Other"])->nullable()->default('Year');
            $table->date('effective_from')->nullable();
            $table->date('effective_to')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
            $table->foreign('course_id', 'fk_tuition_course')->references('course_id')->on('courses')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tuition_fees');
    }
};
