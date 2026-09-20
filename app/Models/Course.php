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
        'course_code',
        'course_name',
        'course_level',
        'field_of_study',
        'duration',
        'tuition_fee',
        'credits',
        'intakes',
        'min_gpa',
        'english_requirement',
        'prerequisites',
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

    /**
     * Shape consumed by the admin courses page.
     */
    public function toAdminArray(): array
    {
        return [
            'id' => $this->course_id,
            'code' => $this->course_code ?? '',
            'name' => $this->course_name,
            'universityId' => $this->university_id,
            'university' => $this->university?->university_name ?? '',
            'country' => $this->university?->country?->country_name ?? '',
            'level' => $this->course_level,
            'field' => $this->field_of_study ?? '',
            'mode' => $this->study_mode ?? 'On Campus',
            'duration' => $this->duration ?? '',
            'tuition' => $this->tuition_fee ?? '',
            'credits' => $this->credits ?? '',
            'intakes' => $this->intakes ?? '',
            'minGpa' => $this->min_gpa ?? '',
            'englishReq' => $this->english_requirement ?? '',
            'prerequisites' => $this->prerequisites ?? '',
            'description' => $this->description ?? '',
            'active' => (bool) $this->is_active,
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
        return $this->hasMany(
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