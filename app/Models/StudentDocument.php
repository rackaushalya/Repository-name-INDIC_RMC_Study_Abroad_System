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
        'expiry_date',
        'uploaded_at',
    ];

    protected function casts(): array
    {
        return [
            'uploaded_at' => 'datetime',
            'expiry_date' => 'date',
        ];
    }

    /**
     * Months a document should stay valid for before we warn the student
     * (most universities want 6+ months of validity on a passport).
     */
    public const EXPIRY_WARNING_MONTHS = 6;

    /**
     * 'expired', 'expiring' (inside the warning window) or null.
     */
    public function expiryState(): ?string
    {
        if (!$this->expiry_date) {
            return null;
        }

        if ($this->expiry_date->isPast()) {
            return 'expired';
        }

        if ($this->expiry_date->lte(now()->addMonths(self::EXPIRY_WARNING_MONTHS))) {
            return 'expiring';
        }

        return null;
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
