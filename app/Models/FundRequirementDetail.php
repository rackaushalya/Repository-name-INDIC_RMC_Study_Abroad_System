<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FundRequirementDetail extends Model
{
    protected $table = 'fund_requirement_details';

    protected $primaryKey = 'detail_id';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'fund_requirement_id',
        'expense_category',
        'description',
        'amount',
        'currency',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
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
}