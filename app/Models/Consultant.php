<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultant extends Model
{
    protected $table = 'consultants';

    protected $primaryKey = 'consultant_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'user_id',
        'employee_code',
        'specialization',
        'experience_years',
        'availability_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function assignments()
    {
        return $this->hasMany(
            ConsultantAssignment::class,
            'consultant_id',
            'consultant_id'
        );
    }

    public function appointments()
    {
        return $this->hasMany(
            Appointment::class,
            'consultant_id',
            'consultant_id'
        );
    }

    public function availability()
    {
        return $this->hasMany(
            ConsultantAvailability::class,
            'consultant_id',
            'consultant_id'
        );
    }

    public function consultationRecords()
    {
        return $this->hasMany(
            ConsultationRecord::class,
            'consultant_id',
            'consultant_id'
        );
    }

    public function followUps()
    {
        return $this->hasMany(
            FollowUp::class,
            'consultant_id',
            'consultant_id'
        );
    }
}