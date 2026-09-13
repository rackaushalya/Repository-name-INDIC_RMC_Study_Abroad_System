<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $table = 'leads';

    protected $primaryKey = 'lead_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'source',
        'interested_country_id',
        'interested_course',
        'lead_status',
        'assigned_consultant_id',
        'notes',
    ];

    public function interestedCountry()
    {
        return $this->belongsTo(
            Country::class,
            'interested_country_id',
            'country_id'
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

    public function inquiries()
    {
        return $this->hasMany(
            Inquiry::class,
            'lead_id',
            'lead_id'
        );
    }

    public function communicationHistory()
    {
        return $this->hasMany(
            CommunicationHistory::class,
            'lead_id',
            'lead_id'
        );
    }
}