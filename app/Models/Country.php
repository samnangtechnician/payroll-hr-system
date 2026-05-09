<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    protected $fillable = [
        'name', 'iso2', 'iso3', 'phone_code', 'default_currency_code',
        'is_supported_payroll_country', 'is_active',
    ];

    protected $casts = [
        'is_supported_payroll_country' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }

    public function branches(): HasMany
    {
        return $this->hasMany(Branch::class);
    }
}
