<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
    protected $table = 'scholarships';

    protected $primaryKey = 'scholarship_id';

    public $incrementing = true;

    protected $keyType = 'int';

    /** Award types the admin can choose, with the CSS class used for their badge. */
    public const AWARD_TYPES = [
        'Full Tuition' => 'full',
        'Partial Tuition' => 'partial',
        'Cash Award' => 'grant',
        'Living Stipend' => 'stipend',
    ];

    protected $fillable = [
        'university_id',
        'course_id',
        'scholarship_name',
        'award_type',
        'description',
        'amount',
        'currency',
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
     * The award type to show: the one the admin chose, or (for older rows
     * saved before the choice existed) a best guess from the amounts.
     */
    public function getAwardTypeLabelAttribute(): string
    {
        if ($this->award_type && isset(self::AWARD_TYPES[$this->award_type])) {
            return $this->award_type;
        }

        if ($this->percentage !== null && (float) $this->percentage >= 100) {
            return 'Full Tuition';
        }

        if ($this->percentage !== null) {
            return 'Partial Tuition';
        }

        return 'Cash Award';
    }

    /** CSS class for the award type badge. */
    public function getAwardTypeKeyAttribute(): string
    {
        return self::AWARD_TYPES[$this->award_type_label] ?? '';
    }

    /** Award value for people, e.g. "USD 10,000 + 50% tuition", or null. */
    public function getAwardTextAttribute(): ?string
    {
        $parts = [];

        if ($this->amount !== null) {
            $amount = (float) $this->amount;
            $parts[] = trim(($this->currency ?? '') . ' ' . number_format($amount, fmod($amount, 1) ? 2 : 0));
        }

        if ($this->percentage !== null) {
            $parts[] = rtrim(rtrim(number_format((float) $this->percentage, 2), '0'), '.') . '% tuition';
        }

        return $parts ? implode(' + ', $parts) : null;
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