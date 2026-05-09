<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DailyActivityLogSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'activity_no' => 'ACTIVITY-0001',
                'employee_id' => 1,
                'project_id' => 1,
                'department_id' => 1,
                'activity_date' => now()->subDays(5)->toDateString(),
                'task_title' => 'Demo task_title 1',
                'task_description' => 'Demo task_description 1',
                'start_time' => '09:00:00',
                'end_time' => '09:00:00',
                'total_hours' => 8.00,
                'progress_percent' => 10.00,
                'work_status' => 'Demo work_status 1',
                'attachment_path' => 'storage/demo/daily_activity_logs/attachment_path_1.txt',
                'reviewed_by' => 1,
                'reviewed_at' => now()->subDays(1),
                'approval_status' => 'Demo approval_status 1',
                'manager_comment' => 'Demo manager_comment 1',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
                'deleted_at' => null,
            ],
            [
                'activity_no' => 'ACTIVITY-0002',
                'employee_id' => 1,
                'project_id' => 1,
                'department_id' => 1,
                'activity_date' => now()->subDays(10)->toDateString(),
                'task_title' => 'Demo task_title 2',
                'task_description' => 'Demo task_description 2',
                'start_time' => '09:00:00',
                'end_time' => '09:00:00',
                'total_hours' => 8.00,
                'progress_percent' => 10.00,
                'work_status' => 'Demo work_status 2',
                'attachment_path' => 'storage/demo/daily_activity_logs/attachment_path_2.txt',
                'reviewed_by' => 1,
                'reviewed_at' => now()->subDays(2),
                'approval_status' => 'Demo approval_status 2',
                'manager_comment' => 'Demo manager_comment 2',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
                'deleted_at' => null,
            ],
            [
                'activity_no' => 'ACTIVITY-0003',
                'employee_id' => 1,
                'project_id' => 1,
                'department_id' => 1,
                'activity_date' => now()->subDays(15)->toDateString(),
                'task_title' => 'Demo task_title 3',
                'task_description' => 'Demo task_description 3',
                'start_time' => '09:00:00',
                'end_time' => '09:00:00',
                'total_hours' => 8.00,
                'progress_percent' => 10.00,
                'work_status' => 'Demo work_status 3',
                'attachment_path' => 'storage/demo/daily_activity_logs/attachment_path_3.txt',
                'reviewed_by' => 1,
                'reviewed_at' => now()->subDays(3),
                'approval_status' => 'Demo approval_status 3',
                'manager_comment' => 'Demo manager_comment 3',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
                'deleted_at' => null,
            ],
        ];

        foreach ($rows as $row) {
            DB::table('daily_activity_logs')->updateOrInsert(
                ['activity_no' => $row['activity_no']],
                $row
            );
        }
    }
}
