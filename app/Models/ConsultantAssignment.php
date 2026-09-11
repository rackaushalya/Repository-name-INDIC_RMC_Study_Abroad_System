<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultantAssignment extends Model
{
    protected $table = 'consultant_assignments';

    protected $primaryKey = 'assignment_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'student_id',
        'consultant_id',
        'assigned_by',
        'assignment_status',
        'assigned_at',
        'unassigned_at',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'assigned_at' => 'datetime',
            'unassigned_at' => 'datetime',
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

    public function assignedBy()
    {
        return $this->belongsTo(
            User::class,
            'assigned_by',
            'user_id'
        );
    }
}