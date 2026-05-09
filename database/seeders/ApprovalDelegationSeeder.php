<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApprovalDelegationSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'delegator_user_id' => 1,
                'delegate_user_id' => 1,
                'module' => 'demo_module_1',
                'start_date' => now()->subDays(5)->toDateString(),
                'end_date' => now()->subDays(5)->toDateString(),
                'is_active' => true,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'delegator_user_id' => 1,
                'delegate_user_id' => 1,
                'module' => 'demo_module_2',
                'start_date' => now()->subDays(10)->toDateString(),
                'end_date' => now()->subDays(10)->toDateString(),
                'is_active' => true,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'delegator_user_id' => 1,
                'delegate_user_id' => 1,
                'module' => 'demo_module_3',
                'start_date' => now()->subDays(15)->toDateString(),
                'end_date' => now()->subDays(15)->toDateString(),
                'is_active' => true,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('approval_delegations')->updateOrInsert(
                ['delegator_user_id' => $row['delegator_user_id']],
                $row
            );
        }
    }
}
