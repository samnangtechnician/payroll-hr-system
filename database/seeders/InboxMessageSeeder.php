<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InboxMessageSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'company_id' => 1,
                'sender_user_id' => 1,
                'type' => 'general',
                'subject' => 'Demo subject 1',
                'body' => 'Demo body 1',
                'related_type' => 'general',
                'related_id' => 1,
                'scheduled_at' => now()->subDays(1),
                'sent_at' => now()->subDays(1),
                'status' => 'active',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
                'deleted_at' => null,
            ],
            [
                'company_id' => 1,
                'sender_user_id' => 1,
                'type' => 'general',
                'subject' => 'Demo subject 2',
                'body' => 'Demo body 2',
                'related_type' => 'general',
                'related_id' => 1,
                'scheduled_at' => now()->subDays(2),
                'sent_at' => now()->subDays(2),
                'status' => 'active',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
                'deleted_at' => null,
            ],
            [
                'company_id' => 1,
                'sender_user_id' => 1,
                'type' => 'general',
                'subject' => 'Demo subject 3',
                'body' => 'Demo body 3',
                'related_type' => 'general',
                'related_id' => 1,
                'scheduled_at' => now()->subDays(3),
                'sent_at' => now()->subDays(3),
                'status' => 'active',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
                'deleted_at' => null,
            ],
        ];

        foreach ($rows as $row) {
            DB::table('inbox_messages')->updateOrInsert(
                ['company_id' => $row['company_id']],
                $row
            );
        }
    }
}
