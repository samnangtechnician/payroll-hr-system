<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApprovalRequestSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'approval_workflow_id' => 1,
                'requested_by' => 1,
                'module' => 'demo_module_1',
                'approvable_type' => 'general',
                'approvable_id' => 1,
                'current_level' => 1,
                'status' => 'active',
                'submitted_at' => now()->subDays(1),
                'completed_at' => now()->subDays(1),
                'snapshot' => json_encode([]),
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'approval_workflow_id' => 1,
                'requested_by' => 1,
                'module' => 'demo_module_2',
                'approvable_type' => 'general',
                'approvable_id' => 1,
                'current_level' => 2,
                'status' => 'active',
                'submitted_at' => now()->subDays(2),
                'completed_at' => now()->subDays(2),
                'snapshot' => json_encode([]),
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'approval_workflow_id' => 1,
                'requested_by' => 1,
                'module' => 'demo_module_3',
                'approvable_type' => 'general',
                'approvable_id' => 1,
                'current_level' => 3,
                'status' => 'active',
                'submitted_at' => now()->subDays(3),
                'completed_at' => now()->subDays(3),
                'snapshot' => json_encode([]),
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('approval_requests')->updateOrInsert(
                ['approval_workflow_id' => $row['approval_workflow_id']],
                $row
            );
        }
    }
}
