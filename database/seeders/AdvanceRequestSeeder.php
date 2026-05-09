<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdvanceRequestSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'advance_no' => 'ADVANCE-0001',
                'employee_id' => 1,
                'project_id' => 1,
                'amount' => 600.00,
                'settled_amount' => 600.00,
                'currency_id' => 1,
                'requested_date' => now()->subDays(5)->toDateString(),
                'settlement_due_date' => now()->subDays(5)->toDateString(),
                'purpose' => 'Demo purpose 1',
                'approved_by' => 1,
                'status' => 'active',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
                'deleted_at' => null,
            ],
            [
                'advance_no' => 'ADVANCE-0002',
                'employee_id' => 1,
                'project_id' => 1,
                'amount' => 700.00,
                'settled_amount' => 700.00,
                'currency_id' => 1,
                'requested_date' => now()->subDays(10)->toDateString(),
                'settlement_due_date' => now()->subDays(10)->toDateString(),
                'purpose' => 'Demo purpose 2',
                'approved_by' => 1,
                'status' => 'active',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
                'deleted_at' => null,
            ],
            [
                'advance_no' => 'ADVANCE-0003',
                'employee_id' => 1,
                'project_id' => 1,
                'amount' => 800.00,
                'settled_amount' => 800.00,
                'currency_id' => 1,
                'requested_date' => now()->subDays(15)->toDateString(),
                'settlement_due_date' => now()->subDays(15)->toDateString(),
                'purpose' => 'Demo purpose 3',
                'approved_by' => 1,
                'status' => 'active',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
                'deleted_at' => null,
            ],
        ];

        foreach ($rows as $row) {
            DB::table('advance_requests')->updateOrInsert(
                ['advance_no' => $row['advance_no']],
                $row
            );
        }
    }
}
