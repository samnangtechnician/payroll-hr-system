<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeaveRequestSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'leave_no' => 'LEAVE-0001',
                'employee_id' => 1,
                'leave_type_id' => 1,
                'start_date' => now()->subDays(5)->toDateString(),
                'end_date' => now()->subDays(5)->toDateString(),
                'total_days' => 1.00,
                'is_half_day' => true,
                'half_day_period' => 'AM',
                'reason' => 'Demo reason 1',
                'attachment_path' => 'storage/demo/leave_requests/attachment_path_1.txt',
                'requested_date' => now()->subDays(5)->toDateString(),
                'approved_by' => 1,
                'approved_at' => now()->subDays(1),
                'status' => 'active',
                'approval_note' => 'Demo approval_note 1',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
                'deleted_at' => null,
            ],
            [
                'leave_no' => 'LEAVE-0002',
                'employee_id' => 1,
                'leave_type_id' => 1,
                'start_date' => now()->subDays(10)->toDateString(),
                'end_date' => now()->subDays(10)->toDateString(),
                'total_days' => 1.00,
                'is_half_day' => true,
                'half_day_period' => 'AM',
                'reason' => 'Demo reason 2',
                'attachment_path' => 'storage/demo/leave_requests/attachment_path_2.txt',
                'requested_date' => now()->subDays(10)->toDateString(),
                'approved_by' => 1,
                'approved_at' => now()->subDays(2),
                'status' => 'active',
                'approval_note' => 'Demo approval_note 2',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
                'deleted_at' => null,
            ],
            [
                'leave_no' => 'LEAVE-0003',
                'employee_id' => 1,
                'leave_type_id' => 1,
                'start_date' => now()->subDays(15)->toDateString(),
                'end_date' => now()->subDays(15)->toDateString(),
                'total_days' => 1.00,
                'is_half_day' => true,
                'half_day_period' => 'AM',
                'reason' => 'Demo reason 3',
                'attachment_path' => 'storage/demo/leave_requests/attachment_path_3.txt',
                'requested_date' => now()->subDays(15)->toDateString(),
                'approved_by' => 1,
                'approved_at' => now()->subDays(3),
                'status' => 'active',
                'approval_note' => 'Demo approval_note 3',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
                'deleted_at' => null,
            ],
        ];

        foreach ($rows as $row) {
            DB::table('leave_requests')->updateOrInsert(
                ['leave_no' => $row['leave_no']],
                $row
            );
        }
    }
}
