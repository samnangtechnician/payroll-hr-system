<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApprovalActionSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'approval_request_id' => 1,
                'approver_user_id' => 1,
                'level' => 1,
                'action' => 'Demo action 1',
                'comment' => 'Demo comment 1',
                'acted_at' => now()->subDays(1),
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'approval_request_id' => 1,
                'approver_user_id' => 1,
                'level' => 2,
                'action' => 'Demo action 2',
                'comment' => 'Demo comment 2',
                'acted_at' => now()->subDays(2),
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'approval_request_id' => 1,
                'approver_user_id' => 1,
                'level' => 3,
                'action' => 'Demo action 3',
                'comment' => 'Demo comment 3',
                'acted_at' => now()->subDays(3),
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('approval_actions')->updateOrInsert(
                ['approval_request_id' => $row['approval_request_id']],
                $row
            );
        }
    }
}
