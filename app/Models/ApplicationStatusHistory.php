<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationStatusHistory extends Model
{
    protected $table = 'application_status_history';

    protected $primaryKey = 'history_id';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'application_id',
        'old_status',
        'new_status',
        'changed_by',
        'remarks',
        'changed_at',
    ];

    protected function casts(): array
    {
        return [
            'changed_at' => 'datetime',
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Application
    |--------------------------------------------------------------------------
    */

    public function application()
    {
        return $this->belongsTo(
            Application::class,
            'application_id',
            'application_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | User Who Changed Status
    |--------------------------------------------------------------------------
    */

    public function changedBy()
    {
        return $this->belongsTo(
            User::class,
            'changed_by',
            'user_id'
        );
    }
}