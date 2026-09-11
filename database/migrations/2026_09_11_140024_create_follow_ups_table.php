<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('follow_ups', function (Blueprint $table) {
            $table->integer('follow_up_id')->autoIncrement()->primary();
            $table->integer('application_id');
            $table->integer('consultant_id');
            $table->date('follow_up_date');
            $table->enum('follow_up_type', ["Call", "Email", "Message", "Meeting", "Other"])->nullable()->default('Call');
            $table->text('notes')->nullable();
            $table->enum('follow_up_status', ["Pending", "Completed", "Cancelled"])->nullable()->default('Pending');
            $table->dateTime('completed_at')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
            $table->foreign('application_id', 'fk_followups_application')->references('application_id')->on('applications')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('consultant_id', 'fk_followups_consultant')->references('consultant_id')->on('consultants')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('follow_ups');
    }
};
