<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectAssignmentSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'project_id' => 1,
                'employee_id' => 1,
                'role_title' => 'Demo role_title 1',
                'hourly_rate' => 10.00,
                'daily_rate' => 10.00,
                'assigned_from' => now()->subDays(5)->toDateString(),
                'assigned_to' => now()->subDays(5)->toDateString(),
                'status' => 'active',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'project_id' => 1,
                'employee_id' => 1,
                'role_title' => 'Demo role_title 2',
                'hourly_rate' => 10.00,
                'daily_rate' => 10.00,
                'assigned_from' => now()->subDays(10)->toDateString(),
                'assigned_to' => now()->subDays(10)->toDateString(),
                'status' => 'active',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'project_id' => 1,
                'employee_id' => 1,
                'role_title' => 'Demo role_title 3',
                'hourly_rate' => 10.00,
                'daily_rate' => 10.00,
                'assigned_from' => now()->subDays(15)->toDateString(),
                'assigned_to' => now()->subDays(15)->toDateString(),
                'status' => 'active',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('project_assignments')->updateOrInsert(
                ['project_id' => $row['project_id']],
                $row
            );
        }
    }
}
