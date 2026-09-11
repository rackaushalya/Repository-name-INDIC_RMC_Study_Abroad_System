<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->integer('notification_id')->autoIncrement()->primary();
            $table->integer('user_id');
            $table->string('title', 255);
            $table->text('message');
            $table->string('notification_type', 100)->nullable();
            $table->integer('related_application_id')->nullable();
            $table->boolean('is_read')->nullable()->default(false);
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->foreign('user_id', 'fk_notifications_user')->references('user_id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('related_application_id', 'fk_notifications_application')->references('application_id')->on('applications')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
