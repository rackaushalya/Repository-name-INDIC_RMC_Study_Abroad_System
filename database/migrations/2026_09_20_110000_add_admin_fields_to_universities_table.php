<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('universities', function (Blueprint $table) {
            $table->string('contact_email', 255)->nullable()->after('website');
            $table->string('category', 150)->nullable()->after('contact_email');
            $table->longText('logo_image')->nullable()->after('category');
        });
    }

    public function down(): void
    {
        Schema::table('universities', function (Blueprint $table) {
            $table->dropColumn([
                'contact_email',
                'category',
                'logo_image',
            ]);
        });
    }
};
