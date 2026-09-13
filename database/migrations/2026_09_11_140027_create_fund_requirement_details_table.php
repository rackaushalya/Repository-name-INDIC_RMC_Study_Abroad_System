<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fund_requirement_details', function (Blueprint $table) {
            $table->integer('detail_id')->autoIncrement()->primary();
            $table->integer('fund_requirement_id');
            $table->string('expense_category', 100);
            $table->string('description', 255)->nullable();
            $table->decimal('amount', 12, 2);
            $table->string('currency', 10)->nullable()->default('LKR');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->foreign('fund_requirement_id', 'fk_fund_details_requirement')->references('fund_requirement_id')->on('fund_requirements')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fund_requirement_details');
    }
};
