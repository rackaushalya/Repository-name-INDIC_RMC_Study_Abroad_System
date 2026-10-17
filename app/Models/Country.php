<?php

namespace App\Models;

use App\Support\CountryCodes;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

    protected $primaryKey = 'country_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'country_name',
        'country_code',
        'description',
        'flag_image',
        'is_active',
    ];

    /**
     * Public URL of the uploaded flag, or null when none was uploaded.
     */
    public function getFlagUrlAttribute(): ?string
    {
        return $this->flag_image
            ? asset('storage/' . $this->flag_image)
            : null;
    }

    /**
     * Automatic flag worked out from the country code or name, or null.
     */
    public function getAutoFlagUrlAttribute(): ?string
    {
        return CountryCodes::flagUrl($this->country_name, $this->country_code);
    }

    /**
     * The flag to show: the uploaded one if there is one, otherwise the automatic one.
     */
    public function getDisplayFlagUrlAttribute(): ?string
    {
        return $this->flag_url ?: $this->auto_flag_url;
    }

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function universities()
    {
        return $this->hasMany(
            University::class,
            'country_id',
            'country_id'
        );
    }

    /** All courses offered by universities in this country. */
    public function courses()
    {
        return $this->hasManyThrough(
            Course::class,
            University::class,
            'country_id',
            'university_id',
            'country_id',
            'university_id'
        );
    }
}