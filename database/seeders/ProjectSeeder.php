<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'company_id' => 1,
                'department_id' => 1,
                'project_code' => 'PROJECT-0001',
                'name' => 'Demo Projects 1',
                'client_name' => 'Demo client_name 1',
                'description' => 'Demo description 1',
                'start_date' => now()->subDays(5)->toDateString(),
                'end_date' => now()->subDays(5)->toDateString(),
                'budget_amount' => 600.00,
                'currency_id' => 1,
                'status' => 'active',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
                'deleted_at' => null,
            ],
            [
                'company_id' => 1,
                'department_id' => 1,
                'project_code' => 'PROJECT-0002',
                'name' => 'Demo Projects 2',
                'client_name' => 'Demo client_name 2',
                'description' => 'Demo description 2',
                'start_date' => now()->subDays(10)->toDateString(),
                'end_date' => now()->subDays(10)->toDateString(),
                'budget_amount' => 700.00,
                'currency_id' => 1,
                'status' => 'active',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
                'deleted_at' => null,
            ],
            [
                'company_id' => 1,
                'department_id' => 1,
                'project_code' => 'PROJECT-0003',
                'name' => 'Demo Projects 3',
                'client_name' => 'Demo client_name 3',
                'description' => 'Demo description 3',
                'start_date' => now()->subDays(15)->toDateString(),
                'end_date' => now()->subDays(15)->toDateString(),
                'budget_amount' => 800.00,
                'currency_id' => 1,
                'status' => 'active',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
                'deleted_at' => null,
            ],
        ];

        foreach ($rows as $row) {
            DB::table('projects')->updateOrInsert(
                ['company_id' => $row['company_id'], 'name' => $row['name']],
                $row
            );
        }
    }
}
