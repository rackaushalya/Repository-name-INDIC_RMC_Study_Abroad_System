<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_documents', function (Blueprint $table) {
            $table->integer('student_document_id')->autoIncrement()->primary();
            $table->integer('student_id');
            $table->integer('required_document_id')->nullable();
            $table->string('document_name', 255);
            $table->string('file_path', 255);
            $table->string('original_name', 255)->nullable();
            $table->string('mime_type', 100)->nullable();
            $table->unsignedInteger('file_size')->nullable();
            $table->enum('status', ["pending", "verified", "rejected"])->nullable()->default('pending');
            $table->text('remarks')->nullable();
            $table->timestamp('uploaded_at')->nullable()->useCurrent();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
            $table->foreign('student_id', 'fk_student_documents_student')->references('student_id')->on('students')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('required_document_id', 'fk_student_documents_required')->references('required_document_id')->on('required_documents')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_documents');
    }
};
