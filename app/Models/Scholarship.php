<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
    protected $table = 'scholarships';

    protected $primaryKey = 'scholarship_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'university_id',
        'course_id',
        'scholarship_name',
        'description',
        'amount',
        'percentage',
        'eligibility',
        'application_deadline',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'percentage' => 'decimal:2',
            'application_deadline' => 'date',
            'is_active' => 'boolean',
        ];
    }

    public function university()
    {
        return $this->belongsTo(
            University::class,
            'university_id',
            'university_id'
        );
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