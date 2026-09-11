<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $table = 'appointments';

    protected $primaryKey = 'appointment_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'student_id',
        'consultant_id',
        'application_id',
        'appointment_date',
        'start_time',
        'end_time',
        'appointment_type',
        'meeting_link',
        'appointment_status',
        'student_notes',
        'consultant_notes',
    ];

    protected function casts(): array
    {
        return [
            'appointment_date' => 'date',
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

    public function consultant()
    {
        return $this->belongsTo(
            Consultant::class,
            'consultant_id',
            'consultant_id'
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
}