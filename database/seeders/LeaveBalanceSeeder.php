<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeaveBalanceSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'employee_id' => 1,
                'leave_type_id' => 1,
                'year' => 2026,
                'entitled_days' => 1.00,
                'carried_forward_days' => 1.00,
                'used_days' => 1.00,
                'pending_days' => 1.00,
                'remaining_days' => 1.00,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'employee_id' => 1,
                'leave_type_id' => 1,
                'year' => 2026,
                'entitled_days' => 1.00,
                'carried_forward_days' => 1.00,
                'used_days' => 1.00,
                'pending_days' => 1.00,
                'remaining_days' => 1.00,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'employee_id' => 1,
                'leave_type_id' => 1,
                'year' => 2026,
                'entitled_days' => 1.00,
                'carried_forward_days' => 1.00,
                'used_days' => 1.00,
                'pending_days' => 1.00,
                'remaining_days' => 1.00,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('leave_balances')->updateOrInsert(
                ['employee_id' => $row['employee_id']],
                $row
            );
        }
    }
}
