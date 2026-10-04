<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    /**
     * Must match the application_status enum on the applications table.
     */
    public const STATUSES = [
        'Submitted',
        'Under Review',
        'Consultant Assigned',
        'Consultation Scheduled',
        'Consultation Completed',
        'Recommendation Provided',
        'Follow-up Required',
        'Completed',
        'Rejected',
        'Cancelled',
    ];

    protected $table = 'applications';

    protected $primaryKey = 'application_id';

    public $incrementing = true;

    public $timestamps = false;

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
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Student
    |--------------------------------------------------------------------------
    */

    public function student()
    {
        return $this->belongsTo(
            Student::class,
            'student_id',
            'student_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Preferred Country
    |--------------------------------------------------------------------------
    */

    public function preferredCountry()
    {
        return $this->belongsTo(
            Country::class,
            'preferred_country_id',
            'country_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Preferred Course
    |--------------------------------------------------------------------------
    */

    public function preferredCourse()
    {
        return $this->belongsTo(
            Course::class,
            'preferred_course_id',
            'course_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Preferred Intake
    |--------------------------------------------------------------------------
    */

    public function preferredIntake()
    {
        return $this->belongsTo(
            CourseIntake::class,
            'preferred_intake_id',
            'intake_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Recommendations
    |--------------------------------------------------------------------------
    */

    public function recommendations()
    {
        return $this->hasMany(
            Recommendation::class,
            'application_id',
            'application_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Appointments
    |--------------------------------------------------------------------------
    */

    public function appointments()
    {
        return $this->hasMany(
            Appointment::class,
            'application_id',
            'application_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Application Status History
    |--------------------------------------------------------------------------
    */

    public function statusHistory()
    {
        return $this->hasMany(
            ApplicationStatusHistory::class,
            'application_id',
            'application_id'
        )->orderBy('changed_at', 'asc');
    }
}