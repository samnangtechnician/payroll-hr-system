<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalaryAdvanceSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'advance_no' => 'ADVANCE-0001',
                'employee_id' => 1,
                'amount' => 600.00,
                'currency_id' => 1,
                'requested_date' => now()->subDays(5)->toDateString(),
                'repayment_start_date' => now()->subDays(5)->toDateString(),
                'repayment_months' => 1,
                'monthly_repayment_amount' => 600.00,
                'reason' => 'Demo reason 1',
                'approved_by' => 1,
                'approved_at' => now()->subDays(1),
                'included_in_payroll' => true,
                'status' => 'active',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
                'deleted_at' => null,
            ],
            [
                'advance_no' => 'ADVANCE-0002',
                'employee_id' => 1,
                'amount' => 700.00,
                'currency_id' => 1,
                'requested_date' => now()->subDays(10)->toDateString(),
                'repayment_start_date' => now()->subDays(10)->toDateString(),
                'repayment_months' => 2,
                'monthly_repayment_amount' => 700.00,
                'reason' => 'Demo reason 2',
                'approved_by' => 1,
                'approved_at' => now()->subDays(2),
                'included_in_payroll' => true,
                'status' => 'active',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
                'deleted_at' => null,
            ],
            [
                'advance_no' => 'ADVANCE-0003',
                'employee_id' => 1,
                'amount' => 800.00,
                'currency_id' => 1,
                'requested_date' => now()->subDays(15)->toDateString(),
                'repayment_start_date' => now()->subDays(15)->toDateString(),
                'repayment_months' => 3,
                'monthly_repayment_amount' => 800.00,
                'reason' => 'Demo reason 3',
                'approved_by' => 1,
                'approved_at' => now()->subDays(3),
                'included_in_payroll' => true,
                'status' => 'active',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
                'deleted_at' => null,
            ],
        ];

        foreach ($rows as $row) {
            DB::table('salary_advances')->updateOrInsert(
                ['advance_no' => $row['advance_no']],
                $row
            );
        }
    }
}
