<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->integer('lead_id')->autoIncrement()->primary();
            $table->string('first_name', 100);
            $table->string('last_name', 100)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('source', 100)->nullable();
            $table->integer('interested_country_id')->nullable();
            $table->string('interested_course', 255)->nullable();
            $table->enum('lead_status', ["New", "Contacted", "Qualified", "Converted", "Lost"])->nullable()->default('New');
            $table->integer('assigned_consultant_id')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
            $table->foreign('interested_country_id', 'fk_leads_country')->references('country_id')->on('countries')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('assigned_consultant_id', 'fk_leads_consultant')->references('consultant_id')->on('consultants')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
