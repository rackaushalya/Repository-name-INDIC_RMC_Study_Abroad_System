<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('required_documents', function (Blueprint $table) {
            $table->integer('required_document_id')->autoIncrement()->primary();
            $table->integer('country_id')->nullable();
            $table->integer('course_id')->nullable();
            $table->string('document_name', 255);
            $table->text('description')->nullable();
            $table->boolean('is_mandatory')->nullable()->default(true);
            $table->boolean('is_active')->nullable()->default(true);
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
            $table->foreign('country_id', 'fk_required_documents_country')->references('country_id')->on('countries')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('course_id', 'fk_required_documents_course')->references('course_id')->on('courses')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('required_documents');
    }
};
