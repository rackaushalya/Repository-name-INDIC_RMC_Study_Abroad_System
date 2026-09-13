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
        'description',
        'is_active',
    ];

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
}