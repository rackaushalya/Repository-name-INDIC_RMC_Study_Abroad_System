<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicQualification extends Model
{
    protected $table = 'academic_qualifications';

    protected $primaryKey = 'qualification_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'student_id',
        'qualification_type',
        'institution_name',
        'qualification_name',
        'field_of_study',
        'start_date',
        'completion_date',
        'grade',
        'gpa',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'completion_date' => 'date',
            'gpa' => 'decimal:2',
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