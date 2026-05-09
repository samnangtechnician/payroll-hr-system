<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PayrollRunItem extends Model
{
    protected $fillable = [
        'payroll_run_id', 'employee_id',
        'basic_salary', 'allowance_amount', 'bonus_amount', 'commission_amount',
        'project_payment_amount', 'overtime_amount', 'salary_advance_amount',
        'deduction_amount', 'unpaid_leave_deduction', 'late_deduction',
        'tax_amount', 'social_contribution_amount',
        'gross_amount', 'total_deduction', 'net_amount',
        'remarks', 'status',
    ];

    protected $casts = [
        'basic_salary' => 'decimal:2',
        'allowance_amount' => 'decimal:2',
        'bonus_amount' => 'decimal:2',
        'commission_amount' => 'decimal:2',
        'project_payment_amount' => 'decimal:2',
        'overtime_amount' => 'decimal:2',
        'salary_advance_amount' => 'decimal:2',
        'deduction_amount' => 'decimal:2',
        'unpaid_leave_deduction' => 'decimal:2',
        'late_deduction' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'social_contribution_amount' => 'decimal:2',
        'gross_amount' => 'decimal:2',
        'total_deduction' => 'decimal:2',
        'net_amount' => 'decimal:2',
    ];

    public function payrollRun(): BelongsTo
    {
        return $this->belongsTo(PayrollRun::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
