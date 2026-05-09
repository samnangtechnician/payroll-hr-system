<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentType extends Model
{
    protected $fillable = [
        'company_id', 'name', 'module', 'requires_expiry_date', 'is_active',
    ];

    protected $casts = [
        'requires_expiry_date' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
