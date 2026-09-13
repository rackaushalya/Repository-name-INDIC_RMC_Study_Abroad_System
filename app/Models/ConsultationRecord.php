<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultationRecord extends Model
{
    protected $table = 'consultation_records';

    protected $primaryKey = 'consultation_record_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'appointment_id',
        'consultant_id',
        'student_id',
        'consultation_summary',
        'consultation_notes',
        'recommendations',
        'next_action',
        'consultation_status',
    ];

    public function appointment()
    {
        return $this->belongsTo(
            Appointment::class,
            'appointment_id',
            'appointment_id'
        );
    }

    public function consultant()
    {
        return $this->belongsTo(
            Consultant::class,
            'consultant_id',
            'consultant_id'
        );
    }

    public function student()
    {
        return $this->belongsTo(
            Student::class,
            'student_id',
            'student_id'
        );
    }
}