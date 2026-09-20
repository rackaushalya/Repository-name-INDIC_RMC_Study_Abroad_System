<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $table = 'universities';

    protected $primaryKey = 'university_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'country_id',
        'university_name',
        'university_code',
        'website',
        'contact_email',
        'category',
        'logo_image',
        'city',
        'address',
        'ranking',
        'description',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'ranking' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Shape consumed by the admin universities page.
     */
    public function toAdminArray(): array
    {
        $this->loadMissing(['country', 'courses']);

        return [
            'id' => (string) $this->university_id,
            'name' => $this->university_name,
            'shortCode' => $this->university_code ?? '',
            'type' => $this->category ?? '',
            'logo' => $this->logo_image,
            'countryId' => $this->country_id,
            'country' => $this->country?->country_name ?? '',
            'countryCode' => $this->country?->country_code ?? '',
            'flag' => $this->country?->flag_image,
            'city' => $this->city ?? '',
            'ranking' => $this->ranking,
            'email' => $this->contact_email ?? '',
            'website' => $this->website ?? '',
            'active' => (bool) $this->is_active,
            'courses' => $this->courses
                ->sortBy('course_name')
                ->map(fn (Course $course) => [
                    'name' => $course->course_name,
                    'degreeLevel' => $course->course_level,
                    'duration' => $course->duration ?? '',
                    'tuition' => $course->tuition_fee ?? '',
                    'intakes' => $course->intakes ?? '',
                    'ielts' => $course->english_requirement ?? '',
                    'active' => (bool) $course->is_active,
                ])
                ->values()
                ->all(),
        ];
    }

    public function country()
    {
        return $this->belongsTo(
            Country::class,
            'country_id',
            'country_id'
        );
    }

    public function courses()
    {
        return $this->hasMany(
            Course::class,
            'university_id',
            'university_id'
        );
    }
}