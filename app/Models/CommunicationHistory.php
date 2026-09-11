<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommunicationHistory extends Model
{
    protected $table = 'communication_history';

    protected $primaryKey = 'communication_id';

    public $incrementing = true;

    protected $keyType = 'int';

    const UPDATED_AT = null;

    protected $fillable = [
        'inquiry_id',
        'application_id',
        'student_id',
        'lead_id',
        'consultant_id',
        'sender_user_id',
        'communication_type',
        'subject',
        'message',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
        ];
    }

    public function inquiry()
    {
        return $this->belongsTo(
            Inquiry::class,
            'inquiry_id',
            'inquiry_id'
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

    public function student()
    {
        return $this->belongsTo(
            Student::class,
            'student_id',
            'student_id'
        );
    }

    public function lead()
    {
        return $this->belongsTo(
            Lead::class,
            'lead_id',
            'lead_id'
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

    public function sender()
    {
        return $this->belongsTo(
            User::class,
            'sender_user_id',
            'user_id'
        );
    }
}