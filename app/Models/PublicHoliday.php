<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PublicHoliday extends Model
{
    protected $fillable = [
        'company_id', 'country_id', 'name', 'holiday_date',
        'is_recurring', 'description',
    ];

    protected $casts = [
        'holiday_date' => 'date',
        'is_recurring' => 'boolean',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
