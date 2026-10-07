<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';

    protected $primaryKey = 'course_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'university_id',
        'course_name',
        'course_level',
        'field_of_study',
        'duration',
        'study_mode',
        'description',
        'application_deadline',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'application_deadline' => 'date',
            'is_active' => 'boolean',
        ];
    }

    public function university()
    {
        return $this->belongsTo(
            University::class,
            'university_id',
            'university_id'
        );
    }

    public function intakes()
    {
        return $this->hasMany(
            CourseIntake::class,
            'course_id',
            'course_id'
        );
    }

    public function tuitionFees()
    {
        return $this->hasMany(
            TuitionFee::class,
            'course_id',
            'course_id'
        );
    }

    public function scholarships()
    {
        return $this->hasMany(
            Scholarship::class,
            'course_id',
            'course_id'
        );
    }

   public function requirements()
    {
    return $this->hasOne(
        CourseRequirement::class,
        'course_id',
        'course_id'
    );
    }

    public function englishRequirements()
    {
        return $this->hasMany(
            EnglishRequirement::class,
            'course_id',
            'course_id'
        );
    }
}