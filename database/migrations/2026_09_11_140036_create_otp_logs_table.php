<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('otp_logs', function (Blueprint $table) {
            $table->bigInteger('otp_id')->autoIncrement()->primary();
            $table->integer('user_id')->nullable();
            $table->string('email', 150);
            $table->string('otp_code', 10);
            $table->enum('otp_type', ["Email Verification", "Password Reset", "Login Verification"]);
            $table->dateTime('expires_at');
            $table->dateTime('verified_at')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->foreign('user_id', 'fk_otp_user')->references('user_id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('otp_logs');
    }
};
