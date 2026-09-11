<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseIntake extends Model
{
    protected $table = 'course_intakes';

    protected $primaryKey = 'intake_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'course_id',
        'intake_name',
        'start_date',
        'application_open_date',
        'application_close_date',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'application_open_date' => 'date',
            'application_close_date' => 'date',
            'is_active' => 'boolean',
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