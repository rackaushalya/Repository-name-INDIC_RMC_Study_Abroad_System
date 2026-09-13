<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequiredDocument extends Model
{
    protected $table = 'required_documents';

    protected $primaryKey = 'required_document_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'country_id',
        'course_id',
        'document_name',
        'description',
        'is_mandatory',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_mandatory' => 'boolean',
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

    public function course()
    {
        return $this->belongsTo(
            Course::class,
            'course_id',
            'course_id'
        );
    }
}