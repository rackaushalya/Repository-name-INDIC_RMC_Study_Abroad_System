<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_intakes', function (Blueprint $table) {
            $table->integer('intake_id')->autoIncrement()->primary();
            $table->integer('course_id');
            $table->string('intake_name', 100);
            $table->string('intake_month', 30)->nullable();
            $table->date('application_open_date')->nullable();
            $table->date('application_close_date')->nullable();
            $table->enum('intake_status', ["Open", "Closed", "Upcoming"])->nullable()->default('Upcoming');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
            $table->foreign('course_id', 'fk_intakes_course')->references('course_id')->on('courses')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_intakes');
    }
};
