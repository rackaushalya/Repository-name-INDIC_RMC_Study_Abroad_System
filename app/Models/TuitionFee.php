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
        'intake_id',
        'fee_amount',
        'currency',
        'fee_type',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'fee_amount' => 'decimal:2',
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

    public function intake()
    {
        return $this->belongsTo(
            CourseIntake::class,
            'intake_id',
            'intake_id'
        );
    }
}