<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'company_id' => 1,
                'user_id' => 1,
                'employee_id' => 1,
                'type' => 'general',
                'channel' => 'Demo channel 1',
                'title' => 'Demo Notifications 1',
                'message' => 'Demo message 1',
                'related_type' => 'general',
                'related_id' => 1,
                'payload' => json_encode([]),
                'sent_at' => now()->subDays(1),
                'read_at' => now()->subDays(1),
                'status' => 'active',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'company_id' => 1,
                'user_id' => 1,
                'employee_id' => 1,
                'type' => 'general',
                'channel' => 'Demo channel 2',
                'title' => 'Demo Notifications 2',
                'message' => 'Demo message 2',
                'related_type' => 'general',
                'related_id' => 1,
                'payload' => json_encode([]),
                'sent_at' => now()->subDays(2),
                'read_at' => now()->subDays(2),
                'status' => 'active',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'company_id' => 1,
                'user_id' => 1,
                'employee_id' => 1,
                'type' => 'general',
                'channel' => 'Demo channel 3',
                'title' => 'Demo Notifications 3',
                'message' => 'Demo message 3',
                'related_type' => 'general',
                'related_id' => 1,
                'payload' => json_encode([]),
                'sent_at' => now()->subDays(3),
                'read_at' => now()->subDays(3),
                'status' => 'active',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('notifications')->updateOrInsert(
                ['company_id' => $row['company_id']],
                $row
            );
        }
    }
}
