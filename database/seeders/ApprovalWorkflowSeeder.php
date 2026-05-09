<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApprovalWorkflowSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'company_id' => 1,
                'department_id' => 1,
                'module' => 'demo_module_1',
                'name' => 'Demo ApprovalWorkflows 1',
                'conditions' => json_encode([]),
                'is_active' => true,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'company_id' => 1,
                'department_id' => 1,
                'module' => 'demo_module_2',
                'name' => 'Demo ApprovalWorkflows 2',
                'conditions' => json_encode([]),
                'is_active' => true,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'company_id' => 1,
                'department_id' => 1,
                'module' => 'demo_module_3',
                'name' => 'Demo ApprovalWorkflows 3',
                'conditions' => json_encode([]),
                'is_active' => true,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('approval_workflows')->updateOrInsert(
                ['company_id' => $row['company_id'], 'name' => $row['name']],
                $row
            );
        }
    }
}
