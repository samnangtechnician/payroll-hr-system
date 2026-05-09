<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContractType extends Model
{
    protected $fillable = ['company_id', 'name', 'default_months', 'description', 'is_active'];

    protected $casts = [
        'default_months' => 'integer',
        'is_active' => 'boolean',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
