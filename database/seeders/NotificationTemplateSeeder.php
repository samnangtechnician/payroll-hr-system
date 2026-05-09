<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationTemplateSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'company_id' => 1,
                'type' => 'general',
                'channel' => 'Demo channel 1',
                'subject' => 'Demo subject 1',
                'body_template' => 'Demo body_template 1',
                'variables' => json_encode([]),
                'is_active' => true,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'company_id' => 1,
                'type' => 'general',
                'channel' => 'Demo channel 2',
                'subject' => 'Demo subject 2',
                'body_template' => 'Demo body_template 2',
                'variables' => json_encode([]),
                'is_active' => true,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'company_id' => 1,
                'type' => 'general',
                'channel' => 'Demo channel 3',
                'subject' => 'Demo subject 3',
                'body_template' => 'Demo body_template 3',
                'variables' => json_encode([]),
                'is_active' => true,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('notification_templates')->updateOrInsert(
                ['company_id' => $row['company_id']],
                $row
            );
        }
    }
}
