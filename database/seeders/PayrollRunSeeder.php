<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PayrollRunSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'payroll_no' => 'PAYROLL-0001',
                'company_id' => 1,
                'payroll_period_id' => 1,
                'country_id' => 1,
                'created_by' => 1,
                'hr_reviewed_by' => 1,
                'finance_reviewed_by' => 1,
                'approved_by' => 1,
                'calculated_at' => now()->subDays(1),
                'approved_at' => now()->subDays(1),
                'paid_at' => now()->subDays(1),
                'gross_amount' => 600.00,
                'total_deduction' => 1.00,
                'net_amount' => 600.00,
                'status' => 'active',
                'calculation_snapshot' => json_encode([]),
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
                'deleted_at' => null,
            ],
            [
                'payroll_no' => 'PAYROLL-0002',
                'company_id' => 1,
                'payroll_period_id' => 1,
                'country_id' => 1,
                'created_by' => 1,
                'hr_reviewed_by' => 1,
                'finance_reviewed_by' => 1,
                'approved_by' => 1,
                'calculated_at' => now()->subDays(2),
                'approved_at' => now()->subDays(2),
                'paid_at' => now()->subDays(2),
                'gross_amount' => 700.00,
                'total_deduction' => 1.00,
                'net_amount' => 700.00,
                'status' => 'active',
                'calculation_snapshot' => json_encode([]),
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
                'deleted_at' => null,
            ],
            [
                'payroll_no' => 'PAYROLL-0003',
                'company_id' => 1,
                'payroll_period_id' => 1,
                'country_id' => 1,
                'created_by' => 1,
                'hr_reviewed_by' => 1,
                'finance_reviewed_by' => 1,
                'approved_by' => 1,
                'calculated_at' => now()->subDays(3),
                'approved_at' => now()->subDays(3),
                'paid_at' => now()->subDays(3),
                'gross_amount' => 800.00,
                'total_deduction' => 1.00,
                'net_amount' => 800.00,
                'status' => 'active',
                'calculation_snapshot' => json_encode([]),
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
                'deleted_at' => null,
            ],
        ];

        foreach ($rows as $row) {
            DB::table('payroll_runs')->updateOrInsert(
                ['payroll_no' => $row['payroll_no']],
                $row
            );
        }
    }
}
