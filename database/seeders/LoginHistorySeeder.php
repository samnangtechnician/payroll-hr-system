<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoginHistorySeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'user_id' => 1,
                'email' => 'login_histories_1@payroll-hr.local',
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0 Demo',
                'device' => 'Demo device 1',
                'browser' => 'Demo browser 1',
                'platform' => 'Demo platform 1',
                'was_successful' => true,
                'failure_reason' => 'Demo failure_reason 1',
                'logged_in_at' => now()->subDays(1),
                'logged_out_at' => now()->subDays(1),
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'user_id' => 1,
                'email' => 'login_histories_2@payroll-hr.local',
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0 Demo',
                'device' => 'Demo device 2',
                'browser' => 'Demo browser 2',
                'platform' => 'Demo platform 2',
                'was_successful' => true,
                'failure_reason' => 'Demo failure_reason 2',
                'logged_in_at' => now()->subDays(2),
                'logged_out_at' => now()->subDays(2),
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'user_id' => 1,
                'email' => 'login_histories_3@payroll-hr.local',
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0 Demo',
                'device' => 'Demo device 3',
                'browser' => 'Demo browser 3',
                'platform' => 'Demo platform 3',
                'was_successful' => true,
                'failure_reason' => 'Demo failure_reason 3',
                'logged_in_at' => now()->subDays(3),
                'logged_out_at' => now()->subDays(3),
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('login_histories')->updateOrInsert(
                ['user_id' => $row['user_id']],
                $row
            );
        }
    }
}
