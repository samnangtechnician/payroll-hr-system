<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSalaryHistorySeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'employee_id' => 1,
                'old_salary' => 600.00,
                'new_salary' => 600.00,
                'currency_id' => 1,
                'effective_date' => now()->subDays(5)->toDateString(),
                'reason' => 'Demo reason 1',
                'approved_by' => 1,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'employee_id' => 1,
                'old_salary' => 700.00,
                'new_salary' => 700.00,
                'currency_id' => 1,
                'effective_date' => now()->subDays(10)->toDateString(),
                'reason' => 'Demo reason 2',
                'approved_by' => 1,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'employee_id' => 1,
                'old_salary' => 800.00,
                'new_salary' => 800.00,
                'currency_id' => 1,
                'effective_date' => now()->subDays(15)->toDateString(),
                'reason' => 'Demo reason 3',
                'approved_by' => 1,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('employee_salary_histories')->updateOrInsert(
                ['employee_id' => $row['employee_id']],
                $row
            );
        }
    }
}
