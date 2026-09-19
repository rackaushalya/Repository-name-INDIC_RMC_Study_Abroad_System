<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentDocument extends Model
{
    protected $table = 'student_documents';

    protected $primaryKey = 'student_document_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'student_id',
        'required_document_id',
        'document_name',
        'file_path',
        'original_name',
        'mime_type',
        'file_size',
        'status',
        'remarks',
        'uploaded_at',
    ];

    protected function casts(): array
    {
        return [
            'uploaded_at' => 'datetime',
        ];
    }

    public function student()
    {
        return $this->belongsTo(
            Student::class,
            'student_id',
            'student_id'
        );
    }

    public function requiredDocument()
    {
        return $this->belongsTo(
            RequiredDocument::class,
            'required_document_id',
            'required_document_id'
        );
    }
}
