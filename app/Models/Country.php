<?php

namespace App\Models;

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
        'capital',
        'key_cities',
        'region',
        'visa_processing_time',
        'funds_required',
        'visa_guidelines',
        'flag_image',
        'description',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    /**
     * Shape consumed by the admin countries page.
     */
    public function toAdminArray(): array
    {
        return [
            'id' => (string) $this->country_id,
            'code' => $this->country_code ?? '',
            'name' => $this->country_name,
            'capital' => $this->capital ?? '',
            'cities' => $this->key_cities ?? '',
            'region' => $this->region ?? '',
            'flag' => $this->flag_image,
            'visaGuidelines' => $this->visa_guidelines ?? '',
            'processingTime' => $this->visa_processing_time ?? '',
            'fundsRequired' => $this->funds_required ?? '',
            'status' => $this->is_active ? 'Active' : 'Inactive',
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
}