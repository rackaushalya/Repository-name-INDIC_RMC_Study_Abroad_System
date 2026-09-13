<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consultant_assignments', function (Blueprint $table) {
            $table->integer('assignment_id')->autoIncrement()->primary();
            $table->integer('application_id');
            $table->integer('consultant_id');
            $table->integer('assigned_by')->nullable();
            $table->timestamp('assigned_at')->nullable()->useCurrent();
            $table->enum('assignment_status', ["Active", "Completed", "Cancelled"])->nullable()->default('Active');
            $table->text('notes')->nullable();
            $table->foreign('application_id', 'fk_assignment_application')->references('application_id')->on('applications')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('consultant_id', 'fk_assignment_consultant')->references('consultant_id')->on('consultants')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('assigned_by', 'fk_assignment_admin')->references('user_id')->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consultant_assignments');
    }
};
