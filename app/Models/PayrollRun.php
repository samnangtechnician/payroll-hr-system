<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PayrollRun extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'payroll_no', 'company_id', 'payroll_period_id', 'country_id',
        'created_by', 'hr_reviewed_by', 'finance_reviewed_by', 'approved_by',
        'calculated_at', 'approved_at', 'paid_at',
        'gross_amount', 'total_deduction', 'net_amount',
        'status', 'calculation_snapshot',
    ];

    protected $casts = [
        'calculated_at' => 'datetime',
        'approved_at' => 'datetime',
        'paid_at' => 'datetime',
        'gross_amount' => 'decimal:2',
        'total_deduction' => 'decimal:2',
        'net_amount' => 'decimal:2',
        'calculation_snapshot' => 'array',
    ];

    public function period(): BelongsTo
    {
        return $this->belongsTo(PayrollPeriod::class, 'payroll_period_id');
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(PayrollRunItem::class);
    }
}
