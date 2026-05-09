<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PayrollItemComponentSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'payroll_run_item_id' => 1,
                'salary_component_id' => 1,
                'component_name' => 'Demo component_name 1',
                'component_type' => 'general',
                'amount' => 600.00,
                'meta' => json_encode([]),
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'payroll_run_item_id' => 1,
                'salary_component_id' => 1,
                'component_name' => 'Demo component_name 2',
                'component_type' => 'general',
                'amount' => 700.00,
                'meta' => json_encode([]),
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'payroll_run_item_id' => 1,
                'salary_component_id' => 1,
                'component_name' => 'Demo component_name 3',
                'component_type' => 'general',
                'amount' => 800.00,
                'meta' => json_encode([]),
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('payroll_item_components')->updateOrInsert(
                ['payroll_run_item_id' => $row['payroll_run_item_id']],
                $row
            );
        }
    }
}
