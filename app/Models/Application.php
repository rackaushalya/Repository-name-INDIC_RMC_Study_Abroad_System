<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $table = 'applications';

    protected $primaryKey = 'application_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'student_id',
        'preferred_country_id',
        'preferred_course_id',
        'preferred_intake_id',
        'application_reference',
        'application_type',
        'application_status',
        'student_message',
        'submitted_at',
    ];

    protected function casts(): array
    {
        return [
            'submitted_at' => 'datetime',
            'updated_at' => 'datetime',
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

    public function preferredCourse()
    {
        return $this->belongsTo(
            Course::class,
            'preferred_course_id',
            'course_id'
        );
    }

    public function preferredIntake()
    {
        return $this->belongsTo(
            CourseIntake::class,
            'preferred_intake_id',
            'intake_id'
        );
    }

    public function recommendations()
    {
        return $this->hasMany(
            Recommendation::class,
            'application_id',
            'application_id'
        );
    }

    public function appointments()
    {
        return $this->hasMany(
            Appointment::class,
            'application_id',
            'application_id'
        );
    }
}