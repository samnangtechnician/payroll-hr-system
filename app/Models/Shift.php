<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shift extends Model
{
    protected $fillable = [
        'company_id', 'shift_code', 'name', 'start_time', 'end_time',
        'break_minutes', 'late_grace_minutes', 'early_leave_grace_minutes',
        'is_night_shift', 'is_active',
    ];

    protected $casts = [
        'break_minutes' => 'integer',
        'late_grace_minutes' => 'integer',
        'early_leave_grace_minutes' => 'integer',
        'is_night_shift' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
