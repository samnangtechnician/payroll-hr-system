<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeShiftSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'employee_id' => 1,
                'shift_id' => 1,
                'effective_from' => now()->subDays(5)->toDateString(),
                'effective_to' => now()->subDays(5)->toDateString(),
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'employee_id' => 1,
                'shift_id' => 1,
                'effective_from' => now()->subDays(10)->toDateString(),
                'effective_to' => now()->subDays(10)->toDateString(),
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'employee_id' => 1,
                'shift_id' => 1,
                'effective_from' => now()->subDays(15)->toDateString(),
                'effective_to' => now()->subDays(15)->toDateString(),
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('employee_shifts')->updateOrInsert(
                ['employee_id' => $row['employee_id']],
                $row
            );
        }
    }
}
