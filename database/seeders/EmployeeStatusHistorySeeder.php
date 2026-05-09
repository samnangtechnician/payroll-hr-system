<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeStatusHistorySeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'employee_id' => 1,
                'old_status' => 'Demo old_status 1',
                'new_status' => 'Demo new_status 1',
                'effective_date' => now()->subDays(5)->toDateString(),
                'reason' => 'Demo reason 1',
                'changed_by' => 1,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'employee_id' => 1,
                'old_status' => 'Demo old_status 2',
                'new_status' => 'Demo new_status 2',
                'effective_date' => now()->subDays(10)->toDateString(),
                'reason' => 'Demo reason 2',
                'changed_by' => 1,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'employee_id' => 1,
                'old_status' => 'Demo old_status 3',
                'new_status' => 'Demo new_status 3',
                'effective_date' => now()->subDays(15)->toDateString(),
                'reason' => 'Demo reason 3',
                'changed_by' => 1,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('employee_status_histories')->updateOrInsert(
                ['employee_id' => $row['employee_id']],
                $row
            );
        }
    }
}
