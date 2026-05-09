<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpenseClaimSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'claim_no' => 'CLAIM-0001',
                'employee_id' => 1,
                'project_id' => 1,
                'department_id' => 1,
                'claim_date' => now()->subDays(5)->toDateString(),
                'total_amount' => 600.00,
                'approved_amount' => 600.00,
                'currency_id' => 1,
                'description' => 'Demo description 1',
                'approved_by' => 1,
                'approved_at' => now()->subDays(1),
                'payment_status' => 'Demo payment_status 1',
                'status' => 'active',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
                'deleted_at' => null,
            ],
            [
                'claim_no' => 'CLAIM-0002',
                'employee_id' => 1,
                'project_id' => 1,
                'department_id' => 1,
                'claim_date' => now()->subDays(10)->toDateString(),
                'total_amount' => 700.00,
                'approved_amount' => 700.00,
                'currency_id' => 1,
                'description' => 'Demo description 2',
                'approved_by' => 1,
                'approved_at' => now()->subDays(2),
                'payment_status' => 'Demo payment_status 2',
                'status' => 'active',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
                'deleted_at' => null,
            ],
            [
                'claim_no' => 'CLAIM-0003',
                'employee_id' => 1,
                'project_id' => 1,
                'department_id' => 1,
                'claim_date' => now()->subDays(15)->toDateString(),
                'total_amount' => 800.00,
                'approved_amount' => 800.00,
                'currency_id' => 1,
                'description' => 'Demo description 3',
                'approved_by' => 1,
                'approved_at' => now()->subDays(3),
                'payment_status' => 'Demo payment_status 3',
                'status' => 'active',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
                'deleted_at' => null,
            ],
        ];

        foreach ($rows as $row) {
            DB::table('expense_claims')->updateOrInsert(
                ['claim_no' => $row['claim_no']],
                $row
            );
        }
    }
}
