<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnglishRequirement extends Model
{
    protected $table = 'english_requirements';

    protected $primaryKey = 'english_requirement_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'course_id',
        'test_type',
        'minimum_overall_score',
        'minimum_listening_score',
        'minimum_reading_score',
        'minimum_writing_score',
        'minimum_speaking_score',
    ];

    protected function casts(): array
    {
        return [
            'minimum_overall_score' => 'decimal:2',
            'minimum_listening_score' => 'decimal:2',
            'minimum_reading_score' => 'decimal:2',
            'minimum_writing_score' => 'decimal:2',
            'minimum_speaking_score' => 'decimal:2',
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