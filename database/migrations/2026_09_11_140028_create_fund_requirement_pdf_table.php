<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fund_requirement_pdf', function (Blueprint $table) {
            $table->integer('pdf_id')->autoIncrement()->primary();
            $table->integer('fund_requirement_id')->unique();
            $table->string('file_name', 255);
            $table->string('file_path', 500);
            $table->integer('generated_by')->nullable();
            $table->timestamp('generated_at')->nullable()->useCurrent();
            $table->foreign('fund_requirement_id', 'fk_fund_pdf_requirement')->references('fund_requirement_id')->on('fund_requirements')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('generated_by', 'fk_fund_pdf_user')->references('user_id')->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fund_requirement_pdf');
    }
};
