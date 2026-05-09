<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeBankAccount extends Model
{
    protected $fillable = [
        'employee_id', 'bank_name', 'bank_branch', 'account_name',
        'account_number', 'swift_code', 'bank_code', 'is_primary', 'is_active',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
