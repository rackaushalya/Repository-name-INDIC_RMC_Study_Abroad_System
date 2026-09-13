<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentPreference extends Model
{
    protected $table = 'student_preferences';

    protected $primaryKey = 'preference_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'student_id',
        'preferred_country_id',
        'preferred_course_field',
        'preferred_course_level',
        'preferred_intake',
        'min_budget',
        'max_budget',
        'preferred_study_mode',
        'preferred_duration',
    ];

    protected function casts(): array
    {
        return [
            'min_budget' => 'decimal:2',
            'max_budget' => 'decimal:2',
        ];
    }

    public function student()
    {
        return $this->belongsTo(
            Student::class,
            'student_id',
            'student_id'
        );
    }

    public function preferredCountry()
    {
        return $this->belongsTo(
            Country::class,
            'preferred_country_id',
            'country_id'
        );
    }
}