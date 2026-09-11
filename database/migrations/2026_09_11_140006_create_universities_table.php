<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('universities', function (Blueprint $table) {
            $table->integer('university_id')->autoIncrement()->primary();
            $table->integer('country_id');
            $table->string('university_name', 255);
            $table->string('university_code', 50)->nullable()->unique();
            $table->string('website', 255)->nullable();
            $table->string('city', 100)->nullable();
            $table->text('address')->nullable();
            $table->integer('ranking')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->nullable()->default(true);
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
            $table->foreign('country_id', 'fk_universities_country')->references('country_id')->on('countries')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('universities');
    }
};
