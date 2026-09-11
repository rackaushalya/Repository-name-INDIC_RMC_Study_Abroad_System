<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consultant_availability', function (Blueprint $table) {
            $table->integer('availability_id')->autoIncrement()->primary();
            $table->integer('consultant_id');
            $table->enum('day_of_week', ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"]);
            $table->time('start_time');
            $table->time('end_time');
            $table->boolean('is_available')->nullable()->default(true);
            $table->foreign('consultant_id', 'fk_availability_consultant')->references('consultant_id')->on('consultants')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consultant_availability');
    }
};
