<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payslip extends Model
{
    protected $fillable = [
        'payroll_run_item_id', 'employee_id', 'payroll_period_id',
        'payslip_no', 'file_path', 'is_published', 'issued_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'issued_at' => 'datetime',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function period(): BelongsTo
    {
        return $this->belongsTo(PayrollPeriod::class, 'payroll_period_id');
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(PayrollRunItem::class, 'payroll_run_item_id');
    }
}
