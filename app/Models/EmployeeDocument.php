<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeDocument extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'employee_id', 'document_type_id', 'document_no', 'title',
        'file_path', 'file_name', 'mime_type', 'file_size',
        'issued_date', 'expiry_date', 'uploaded_by', 'status',
    ];

    protected $casts = [
        'issued_date' => 'date',
        'expiry_date' => 'date',
        'file_size' => 'integer',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function documentType(): BelongsTo
    {
        return $this->belongsTo(DocumentType::class);
    }
}
