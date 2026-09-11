<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->integer('report_id')->autoIncrement()->primary();
            $table->string('report_name', 255);
            $table->string('report_type', 100)->nullable();
            $table->integer('generated_by')->nullable();
            $table->json('report_data')->nullable();
            $table->timestamp('generated_at')->nullable()->useCurrent();
            $table->foreign('generated_by', 'fk_reports_user')->references('user_id')->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
