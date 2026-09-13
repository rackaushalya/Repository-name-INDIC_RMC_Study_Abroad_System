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