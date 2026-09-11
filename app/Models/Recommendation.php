<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    protected $table = 'recommendations';

    protected $primaryKey = 'recommendation_id';

    public $incrementing = true;

    protected $keyType = 'int';

    const UPDATED_AT = null;

    protected $fillable = [
        'student_id',
        'application_id',
        'course_id',
        'match_percentage',
        'qualification_match',
        'english_match',
        'budget_match',
        'preference_match',
        'work_experience_match',
        'recommendation_reason',
        'recommendation_status',
    ];

    protected function casts(): array
    {
        return [
            'match_percentage' => 'decimal:2',
            'qualification_match' => 'boolean',
            'english_match' => 'boolean',
            'budget_match' => 'boolean',
            'preference_match' => 'boolean',
            'work_experience_match' => 'boolean',
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

    public function application()
    {
        return $this->belongsTo(
            Application::class,
            'application_id',
            'application_id'
        );
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