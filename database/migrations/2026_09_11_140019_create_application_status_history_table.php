<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('application_status_history', function (Blueprint $table) {
            $table->integer('history_id')->autoIncrement()->primary();
            $table->integer('application_id');
            $table->string('old_status', 100)->nullable();
            $table->string('new_status', 100);
            $table->integer('changed_by')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamp('changed_at')->nullable()->useCurrent();
            $table->foreign('application_id', 'fk_status_history_application')->references('application_id')->on('applications')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('changed_by', 'fk_status_history_user')->references('user_id')->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('application_status_history');
    }
};
