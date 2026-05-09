<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SalaryComponent extends Model
{
    protected $fillable = [
        'company_id', 'component_code', 'name', 'type',
        'is_taxable', 'is_fixed', 'is_system', 'is_active',
    ];

    protected $casts = [
        'is_taxable' => 'boolean',
        'is_fixed' => 'boolean',
        'is_system' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
