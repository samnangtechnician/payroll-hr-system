<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PayrollRunItemSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'payroll_run_id' => 1,
                'employee_id' => 1,
                'basic_salary' => 600.00,
                'allowance_amount' => 600.00,
                'bonus_amount' => 600.00,
                'commission_amount' => 600.00,
                'project_payment_amount' => 600.00,
                'overtime_amount' => 600.00,
                'salary_advance_amount' => 600.00,
                'deduction_amount' => 600.00,
                'unpaid_leave_deduction' => 1.00,
                'late_deduction' => 1.00,
                'tax_amount' => 600.00,
                'social_contribution_amount' => 600.00,
                'gross_salary' => 600.00,
                'net_salary' => 600.00,
                'status' => 'active',
                'calculation_detail' => json_encode([]),
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'payroll_run_id' => 1,
                'employee_id' => 1,
                'basic_salary' => 700.00,
                'allowance_amount' => 700.00,
                'bonus_amount' => 700.00,
                'commission_amount' => 700.00,
                'project_payment_amount' => 700.00,
                'overtime_amount' => 700.00,
                'salary_advance_amount' => 700.00,
                'deduction_amount' => 700.00,
                'unpaid_leave_deduction' => 1.00,
                'late_deduction' => 1.00,
                'tax_amount' => 700.00,
                'social_contribution_amount' => 700.00,
                'gross_salary' => 700.00,
                'net_salary' => 700.00,
                'status' => 'active',
                'calculation_detail' => json_encode([]),
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'payroll_run_id' => 1,
                'employee_id' => 1,
                'basic_salary' => 800.00,
                'allowance_amount' => 800.00,
                'bonus_amount' => 800.00,
                'commission_amount' => 800.00,
                'project_payment_amount' => 800.00,
                'overtime_amount' => 800.00,
                'salary_advance_amount' => 800.00,
                'deduction_amount' => 800.00,
                'unpaid_leave_deduction' => 1.00,
                'late_deduction' => 1.00,
                'tax_amount' => 800.00,
                'social_contribution_amount' => 800.00,
                'gross_salary' => 800.00,
                'net_salary' => 800.00,
                'status' => 'active',
                'calculation_detail' => json_encode([]),
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('payroll_run_items')->updateOrInsert(
                ['payroll_run_id' => $row['payroll_run_id']],
                $row
            );
        }
    }
}
