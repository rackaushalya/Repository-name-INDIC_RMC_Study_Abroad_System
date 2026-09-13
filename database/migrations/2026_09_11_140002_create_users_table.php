<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->integer('user_id')->autoIncrement()->primary();
            $table->integer('role_id');
            $table->string('first_name', 100);
            $table->string('last_name', 100)->nullable();
            $table->string('email', 150)->unique();
            $table->string('password_hash', 255)->nullable();
            $table->string('google_id', 191)->nullable()->unique();
            $table->string('phone', 30)->nullable();
            $table->string('profile_image', 255)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('account_status', ["active", "inactive", "suspended"])->nullable()->default('active');
            $table->timestamp('last_login_at')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
            $table->foreign('role_id', 'fk_users_role')->references('role_id')->on('roles')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
