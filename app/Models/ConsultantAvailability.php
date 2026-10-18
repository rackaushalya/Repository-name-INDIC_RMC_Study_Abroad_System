<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultantAvailability extends Model
{
    protected $table = 'consultant_availability';

    protected $primaryKey = 'availability_id';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'consultant_id',
        'day_of_week',
        'start_time',
        'end_time',
        'is_available',
    ];

    protected function casts(): array
    {
        return [
            'is_available' => 'boolean',
        ];
    }

    public function consultant()
    {
        return $this->belongsTo(
            Consultant::class,
            'consultant_id',
            'consultant_id'
        );
    }
}