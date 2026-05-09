<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttendanceRecordSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'employee_id' => 1,
                'shift_id' => 1,
                'attendance_date' => now()->subDays(5)->toDateString(),
                'check_in_at' => now()->subDays(1),
                'check_out_at' => now()->subDays(1),
                'total_working_hours' => 8.00,
                'late_minutes' => 60,
                'early_leave_minutes' => 60,
                'ot_hours' => 8.00,
                'attendance_status' => 'Demo attendance_status 1',
                'work_mode' => 'Demo work_mode 1',
                'check_in_latitude' => 1.00,
                'check_in_longitude' => 1.00,
                'check_out_latitude' => 1.00,
                'check_out_longitude' => 1.00,
                'biometric_device_id' => 'Demo biometric_device_id 1',
                'is_manual' => true,
                'manual_reason' => 'Demo manual_reason 1',
                'approved_by' => 1,
                'approved_at' => now()->subDays(1),
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
                'deleted_at' => null,
            ],
            [
                'employee_id' => 1,
                'shift_id' => 1,
                'attendance_date' => now()->subDays(10)->toDateString(),
                'check_in_at' => now()->subDays(2),
                'check_out_at' => now()->subDays(2),
                'total_working_hours' => 8.00,
                'late_minutes' => 60,
                'early_leave_minutes' => 60,
                'ot_hours' => 8.00,
                'attendance_status' => 'Demo attendance_status 2',
                'work_mode' => 'Demo work_mode 2',
                'check_in_latitude' => 1.00,
                'check_in_longitude' => 1.00,
                'check_out_latitude' => 1.00,
                'check_out_longitude' => 1.00,
                'biometric_device_id' => 'Demo biometric_device_id 2',
                'is_manual' => true,
                'manual_reason' => 'Demo manual_reason 2',
                'approved_by' => 1,
                'approved_at' => now()->subDays(2),
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
                'deleted_at' => null,
            ],
            [
                'employee_id' => 1,
                'shift_id' => 1,
                'attendance_date' => now()->subDays(15)->toDateString(),
                'check_in_at' => now()->subDays(3),
                'check_out_at' => now()->subDays(3),
                'total_working_hours' => 8.00,
                'late_minutes' => 60,
                'early_leave_minutes' => 60,
                'ot_hours' => 8.00,
                'attendance_status' => 'Demo attendance_status 3',
                'work_mode' => 'Demo work_mode 3',
                'check_in_latitude' => 1.00,
                'check_in_longitude' => 1.00,
                'check_out_latitude' => 1.00,
                'check_out_longitude' => 1.00,
                'biometric_device_id' => 'Demo biometric_device_id 3',
                'is_manual' => true,
                'manual_reason' => 'Demo manual_reason 3',
                'approved_by' => 1,
                'approved_at' => now()->subDays(3),
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
                'deleted_at' => null,
            ],
        ];

        foreach ($rows as $row) {
            DB::table('attendance_records')->updateOrInsert(
                ['employee_id' => $row['employee_id']],
                $row
            );
        }
    }
}
