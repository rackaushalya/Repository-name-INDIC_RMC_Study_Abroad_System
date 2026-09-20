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
        'scholarship_code',
        'scholarship_name',
        'coverage_type',
        'award_value',
        'degree_level',
        'field_of_study',
        'min_gpa',
        'quota',
        'category',
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

    /**
     * Shape consumed by the admin scholarships page.
     */
    public function toAdminArray(): array
    {
        $this->loadMissing('university.country');

        return [
            'id' => $this->scholarship_id,
            'code' => $this->scholarship_code ?? '',
            'name' => $this->scholarship_name,
            'universityId' => $this->university_id,
            'university' => $this->university?->university_name ?? '',
            'country' => $this->university?->country?->country_name ?? '',
            'coverage' => $this->coverage_type ?? '',
            'amount' => $this->award_value ?? '',
            'level' => $this->degree_level ?? '',
            'field' => $this->field_of_study ?? '',
            'minGpa' => $this->min_gpa ?? '',
            'deadline' => $this->application_deadline?->format('Y-m-d') ?? '',
            'quota' => $this->quota ?? '',
            'category' => $this->category ?? '',
            'eligibility' => $this->eligibility ?? '',
            'description' => $this->description ?? '',
            'active' => (bool) $this->is_active,
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