<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeaveType extends Model
{
    protected $fillable = [
        'company_id', 'country_id', 'name', 'code',
        'default_entitlement_days', 'is_paid', 'allow_half_day',
        'requires_attachment', 'is_active',
    ];

    protected $casts = [
        'is_paid' => 'boolean',
        'allow_half_day' => 'boolean',
        'requires_attachment' => 'boolean',
        'default_entitlement_days' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
