<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->string('capital', 100)->nullable()->after('country_code');
            $table->string('key_cities', 255)->nullable()->after('capital');
            $table->string('region', 50)->nullable()->after('key_cities');
            $table->string('visa_processing_time', 100)->nullable()->after('region');
            $table->string('funds_required', 255)->nullable()->after('visa_processing_time');
            $table->text('visa_guidelines')->nullable()->after('funds_required');
            $table->longText('flag_image')->nullable()->after('visa_guidelines');
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->string('course_code', 50)->nullable()->unique()->after('university_id');
            $table->string('tuition_fee', 100)->nullable()->after('duration');
            $table->string('credits', 100)->nullable()->after('tuition_fee');
            $table->string('intakes', 255)->nullable()->after('credits');
            $table->string('min_gpa', 100)->nullable()->after('intakes');
            $table->string('english_requirement', 255)->nullable()->after('min_gpa');
            $table->text('prerequisites')->nullable()->after('english_requirement');
        });

        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE courses MODIFY course_level ENUM('Certificate','Diploma','Bachelor','Master','MBA','PhD') NOT NULL");
        }
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'mysql') {
            DB::table('courses')->where('course_level', 'MBA')->update(['course_level' => 'Master']);
            DB::statement("ALTER TABLE courses MODIFY course_level ENUM('Certificate','Diploma','Bachelor','Master','PhD') NOT NULL");
        }

        Schema::table('courses', function (Blueprint $table) {
            $table->dropUnique(['course_code']);
            $table->dropColumn([
                'course_code',
                'tuition_fee',
                'credits',
                'intakes',
                'min_gpa',
                'english_requirement',
                'prerequisites',
            ]);
        });

        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn([
                'capital',
                'key_cities',
                'region',
                'visa_processing_time',
                'funds_required',
                'visa_guidelines',
                'flag_image',
            ]);
        });
    }
};
