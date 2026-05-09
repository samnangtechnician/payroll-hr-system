<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InboxRecipientSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'inbox_message_id' => 1,
                'recipient_user_id' => 1,
                'recipient_employee_id' => 1,
                'read_at' => now()->subDays(1),
                'archived_at' => now()->subDays(1),
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'inbox_message_id' => 1,
                'recipient_user_id' => 1,
                'recipient_employee_id' => 1,
                'read_at' => now()->subDays(2),
                'archived_at' => now()->subDays(2),
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'inbox_message_id' => 1,
                'recipient_user_id' => 1,
                'recipient_employee_id' => 1,
                'read_at' => now()->subDays(3),
                'archived_at' => now()->subDays(3),
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('inbox_recipients')->updateOrInsert(
                ['inbox_message_id' => $row['inbox_message_id']],
                $row
            );
        }
    }
}
