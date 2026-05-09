<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSalaryComponentSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'employee_id' => 1,
                'salary_component_id' => 1,
                'amount' => 600.00,
                'percentage' => 10.00,
                'effective_from' => now()->subDays(5)->toDateString(),
                'effective_to' => now()->subDays(5)->toDateString(),
                'is_active' => true,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'employee_id' => 1,
                'salary_component_id' => 1,
                'amount' => 700.00,
                'percentage' => 10.00,
                'effective_from' => now()->subDays(10)->toDateString(),
                'effective_to' => now()->subDays(10)->toDateString(),
                'is_active' => true,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'employee_id' => 1,
                'salary_component_id' => 1,
                'amount' => 800.00,
                'percentage' => 10.00,
                'effective_from' => now()->subDays(15)->toDateString(),
                'effective_to' => now()->subDays(15)->toDateString(),
                'is_active' => true,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('employee_salary_components')->updateOrInsert(
                ['employee_id' => $row['employee_id']],
                $row
            );
        }
    }
}
