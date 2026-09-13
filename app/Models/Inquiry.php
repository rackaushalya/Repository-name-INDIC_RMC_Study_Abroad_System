<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $table = 'inquiries';

    protected $primaryKey = 'inquiry_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'lead_id',
        'student_id',
        'inquiry_subject',
        'inquiry_message',
        'inquiry_status',
        'assigned_consultant_id',
    ];

    public function lead()
    {
        return $this->belongsTo(
            Lead::class,
            'lead_id',
            'lead_id'
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

    public function assignedConsultant()
    {
        return $this->belongsTo(
            Consultant::class,
            'assigned_consultant_id',
            'consultant_id'
        );
    }

    public function communicationHistory()
    {
        return $this->hasMany(
            CommunicationHistory::class,
            'inquiry_id',
            'inquiry_id'
        );
    }
}