<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'reports';

    protected $primaryKey = 'report_id';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'report_name',
        'report_type',
        'generated_by',
        'report_data',
        'generated_at',
    ];

    protected function casts(): array
    {
        return [
            'report_data' => 'array',
            'generated_at' => 'datetime',
        ];
    }

    public function generatedBy()
    {
        return $this->belongsTo(
            User::class,
            'generated_by',
            'user_id'
        );
    }
}