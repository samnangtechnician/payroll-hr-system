<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeaveRequestDateSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'leave_request_id' => 1,
                'leave_date' => now()->subDays(5)->toDateString(),
                'days' => 1.00,
                'is_paid' => true,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'leave_request_id' => 1,
                'leave_date' => now()->subDays(10)->toDateString(),
                'days' => 1.00,
                'is_paid' => true,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'leave_request_id' => 1,
                'leave_date' => now()->subDays(15)->toDateString(),
                'days' => 1.00,
                'is_paid' => true,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('leave_request_dates')->updateOrInsert(
                ['leave_request_id' => $row['leave_request_id']],
                $row
            );
        }
    }
}
