<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FollowUp extends Model
{
    protected $table = 'follow_ups';

    protected $primaryKey = 'follow_up_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'consultant_id',
        'application_id',
        'follow_up_date',
        'follow_up_type',
        'notes',
        'follow_up_status',
        'completed_at',
    ];

    protected function casts(): array
    {
        return [
            'follow_up_date' => 'date',
            'completed_at' => 'datetime',
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