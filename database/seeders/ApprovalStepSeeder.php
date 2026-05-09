<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApprovalStepSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'approval_workflow_id' => 1,
                'level' => 1,
                'approver_type' => 'general',
                'approver_user_id' => 1,
                'approver_role_id' => 1,
                'is_required' => true,
                'rules' => json_encode([]),
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'approval_workflow_id' => 1,
                'level' => 2,
                'approver_type' => 'general',
                'approver_user_id' => 1,
                'approver_role_id' => 1,
                'is_required' => true,
                'rules' => json_encode([]),
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'approval_workflow_id' => 1,
                'level' => 3,
                'approver_type' => 'general',
                'approver_user_id' => 1,
                'approver_role_id' => 1,
                'is_required' => true,
                'rules' => json_encode([]),
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('approval_steps')->updateOrInsert(
                ['approval_workflow_id' => $row['approval_workflow_id']],
                $row
            );
        }
    }
}
