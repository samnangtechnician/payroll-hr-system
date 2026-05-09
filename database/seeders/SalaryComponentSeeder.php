<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalaryComponentSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'company_id' => 1,
                'component_code' => 'COMPONENT-0001',
                'name' => 'Demo SalaryComponents 1',
                'type' => 'general',
                'is_taxable' => true,
                'is_fixed' => true,
                'is_system' => true,
                'is_active' => true,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'company_id' => 1,
                'component_code' => 'COMPONENT-0002',
                'name' => 'Demo SalaryComponents 2',
                'type' => 'general',
                'is_taxable' => true,
                'is_fixed' => true,
                'is_system' => true,
                'is_active' => true,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'company_id' => 1,
                'component_code' => 'COMPONENT-0003',
                'name' => 'Demo SalaryComponents 3',
                'type' => 'general',
                'is_taxable' => true,
                'is_fixed' => true,
                'is_system' => true,
                'is_active' => true,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('salary_components')->updateOrInsert(
                ['company_id' => $row['company_id'], 'name' => $row['name']],
                $row
            );
        }
    }
}
