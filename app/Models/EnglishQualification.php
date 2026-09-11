<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnglishQualification extends Model
{
    protected $table = 'english_qualifications';

    protected $primaryKey = 'english_qualification_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'student_id',
        'test_type',
        'overall_score',
        'listening_score',
        'reading_score',
        'writing_score',
        'speaking_score',
        'test_date',
        'expiry_date',
        'certificate_number',
    ];

    protected function casts(): array
    {
        return [
            'overall_score' => 'decimal:2',
            'listening_score' => 'decimal:2',
            'reading_score' => 'decimal:2',
            'writing_score' => 'decimal:2',
            'speaking_score' => 'decimal:2',
            'test_date' => 'date',
            'expiry_date' => 'date',
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
}