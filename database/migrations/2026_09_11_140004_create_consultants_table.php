<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consultants', function (Blueprint $table) {
            $table->integer('consultant_id')->autoIncrement()->primary();
            $table->integer('user_id')->unique();
            $table->string('employee_code', 50)->unique();
            $table->string('specialization', 255)->nullable();
            $table->integer('years_of_experience')->nullable()->default(0);
            $table->text('bio')->nullable();
            $table->enum('consultant_status', ["active", "inactive", "on_leave"])->nullable()->default('active');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
            $table->foreign('user_id', 'fk_consultants_user')->references('user_id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consultants');
    }
};
