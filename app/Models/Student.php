<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

    protected $primaryKey = 'student_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'user_id',
        'date_of_birth',
        'gender',
        'nationality',
        'passport_number',
        'current_address',
        'city',
        'country',
    ];

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function academicQualifications()
    {
        return $this->hasMany(
            AcademicQualification::class,
            'student_id',
            'student_id'
        );
    }

    public function englishQualifications()
    {
        return $this->hasMany(
            EnglishQualification::class,
            'student_id',
            'student_id'
        );
    }

    public function workExperiences()
    {
        return $this->hasMany(
            WorkExperience::class,
            'student_id',
            'student_id'
        );
    }

    public function preferences()
    {
        return $this->hasOne(
            StudentPreference::class,
            'student_id',
            'student_id'
        );
    }

    public function applications()
    {
        return $this->hasMany(
            Application::class,
            'student_id',
            'student_id'
        );
    }

    public function recommendations()
    {
        return $this->hasMany(
            Recommendation::class,
            'student_id',
            'student_id'
        );
    }

    public function appointments()
    {
        return $this->hasMany(
            Appointment::class,
            'student_id',
            'student_id'
        );
    }

    public function fundRequirements()
    {
        return $this->hasMany(
            FundRequirement::class,
            'student_id',
            'student_id'
        );
    }

    public function documents()
    {
        return $this->hasMany(
            StudentDocument::class,
            'student_id',
            'student_id'
        );
    }
}
