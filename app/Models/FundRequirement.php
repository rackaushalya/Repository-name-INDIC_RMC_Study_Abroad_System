<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FundRequirement extends Model
{
    protected $table = 'fund_requirements';

    protected $primaryKey = 'fund_requirement_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'student_id',
        'application_id',
        'selected_country_id',
        'selected_course_id',
        'total_tuition',
        'total_living_cost',
        'total_travel_cost',
        'total_other_cost',
        'scholarship_amount',
        'total_required_amount',
        'currency',
        'notes',
        'generated_by',
        'generated_at',
    ];

    protected function casts(): array
    {
        return [
            'total_tuition' => 'decimal:2',
            'total_living_cost' => 'decimal:2',
            'total_travel_cost' => 'decimal:2',
            'total_other_cost' => 'decimal:2',
            'scholarship_amount' => 'decimal:2',
            'total_required_amount' => 'decimal:2',
            'generated_at' => 'datetime',
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

    public function application()
    {
        return $this->belongsTo(
            Application::class,
            'application_id',
            'application_id'
        );
    }

    public function selectedCountry()
    {
        return $this->belongsTo(
            Country::class,
            'selected_country_id',
            'country_id'
        );
    }

    public function selectedCourse()
    {
        return $this->belongsTo(
            Course::class,
            'selected_course_id',
            'course_id'
        );
    }

    public function generatedBy()
    {
        return $this->belongsTo(
            User::class,
            'generated_by',
            'user_id'
        );
    }

    public function details()
    {
        return $this->hasMany(
            FundRequirementDetail::class,
            'fund_requirement_id',
            'fund_requirement_id'
        );
    }

    public function pdf()
    {
        return $this->hasOne(
            FundRequirementPdf::class,
            'fund_requirement_id',
            'fund_requirement_id'
        );
    }
}