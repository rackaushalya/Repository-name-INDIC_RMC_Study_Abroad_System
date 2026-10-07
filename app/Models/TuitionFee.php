<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TuitionFee extends Model
{
    protected $table = 'tuition_fees';

    protected $primaryKey = 'tuition_fee_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'course_id',
        'amount',
        'currency',
        'fee_period',
        'effective_from',
        'effective_to',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'effective_from' => 'date',
            'effective_to' => 'date',
        ];
    }

    public function course()
    {
        return $this->belongsTo(
            Course::class,
            'course_id',
            'course_id'
        );
    }
}