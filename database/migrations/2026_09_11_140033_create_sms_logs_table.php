<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sms_logs', function (Blueprint $table) {
            $table->bigInteger('sms_id')->autoIncrement()->primary();
            $table->integer('user_id')->nullable();
            $table->integer('student_id')->nullable();
            $table->integer('application_id')->nullable();
            $table->string('phone_number', 30);
            $table->text('message');
            $table->string('sms_type', 100)->nullable();
            $table->string('provider', 100)->nullable();
            $table->string('provider_message_id', 255)->nullable();
            $table->enum('sms_status', ["Pending", "Sent", "Delivered", "Failed"])->nullable()->default('Pending');
            $table->dateTime('sent_at')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->foreign('user_id', 'fk_sms_user')->references('user_id')->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('student_id', 'fk_sms_student')->references('student_id')->on('students')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('application_id', 'fk_sms_application')->references('application_id')->on('applications')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sms_logs');
    }
};
