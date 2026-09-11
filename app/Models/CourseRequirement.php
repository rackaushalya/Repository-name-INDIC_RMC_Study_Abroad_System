<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseRequirement extends Model
{
    protected $table = 'course_requirements';

    protected $primaryKey = 'requirement_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'course_id',
        'minimum_gpa',
        'minimum_age',
        'maximum_age',
        'minimum_work_experience_months',
        'required_qualification_level',
        'required_field',
        'other_requirements',
    ];

    protected function casts(): array
    {
        return [
            'minimum_gpa' => 'decimal:2',
            'minimum_age' => 'integer',
            'maximum_age' => 'integer',
            'minimum_work_experience_months' => 'integer',
        ];
    }

    public function course()
    {
        return $this->belongsTo(
            Course::class,
            'course_id',
            'course_id'
        );
    }
}