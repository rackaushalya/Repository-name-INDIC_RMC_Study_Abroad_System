<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'years_of_experience',
        'bio',
        'consultant_status',
    ];

    protected $casts = [
        'years_of_experience' => 'integer',
    ];

    /**
     * Consultant belongs to a User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'user_id',
            'user_id'
        );
    }

    /**
     * Get the consultant's assignments.
     */
    public function assignments()
    {
        return $this->hasMany(
            ConsultantAssignment::class,
            'consultant_id',
            'consultant_id'
        );
    }

    /**
     * Get the consultant's appointments.
     */
    public function appointments()
    {
        return $this->hasMany(
            Appointment::class,
            'consultant_id',
            'consultant_id'
        );
    }

    /**
     * Get the consultant's consultation records.
     */
    public function consultationRecords()
    {
        return $this->hasMany(
            ConsultationRecord::class,
            'consultant_id',
            'consultant_id'
        );
    }

    /**
     * Get the consultant's follow-ups.
     */
    public function followUps()
    {
        return $this->hasMany(
            FollowUp::class,
            'consultant_id',
            'consultant_id'
        );
    }
}