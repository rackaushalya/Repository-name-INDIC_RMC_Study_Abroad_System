<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FundRequirementPdf extends Model
{
    protected $table = 'fund_requirement_pdf';

    protected $primaryKey = 'pdf_id';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'fund_requirement_id',
        'file_name',
        'file_path',
        'generated_by',
        'generated_at',
    ];

    protected function casts(): array
    {
        return [
            'generated_at' => 'datetime',
        ];
    }

    public function fundRequirement()
    {
        return $this->belongsTo(
            FundRequirement::class,
            'fund_requirement_id',
            'fund_requirement_id'
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
}