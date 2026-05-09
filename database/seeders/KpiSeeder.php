<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KpiSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'kpi_code' => 'KPI-0001',
                'company_id' => 1,
                'department_id' => 1,
                'name' => 'Demo Kpis 1',
                'description' => 'Demo description 1',
                'target_value' => 1.00,
                'unit' => 'Demo unit 1',
                'weight_percent' => 10.00,
                'status' => 'active',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
                'deleted_at' => null,
            ],
            [
                'kpi_code' => 'KPI-0002',
                'company_id' => 1,
                'department_id' => 1,
                'name' => 'Demo Kpis 2',
                'description' => 'Demo description 2',
                'target_value' => 1.00,
                'unit' => 'Demo unit 2',
                'weight_percent' => 10.00,
                'status' => 'active',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
                'deleted_at' => null,
            ],
            [
                'kpi_code' => 'KPI-0003',
                'company_id' => 1,
                'department_id' => 1,
                'name' => 'Demo Kpis 3',
                'description' => 'Demo description 3',
                'target_value' => 1.00,
                'unit' => 'Demo unit 3',
                'weight_percent' => 10.00,
                'status' => 'active',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
                'deleted_at' => null,
            ],
        ];

        foreach ($rows as $row) {
            DB::table('kpis')->updateOrInsert(
                ['kpi_code' => $row['kpi_code']],
                $row
            );
        }
    }
}
