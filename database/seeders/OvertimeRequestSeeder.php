<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OvertimeRequestSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'ot_no' => 'OT-0001',
                'employee_id' => 1,
                'attendance_record_id' => 1,
                'ot_date' => now()->subDays(5)->toDateString(),
                'ot_type' => 'general',
                'start_at' => now()->subDays(1),
                'end_at' => now()->subDays(1),
                'ot_hours' => 8.00,
                'ot_rate' => 10.00,
                'ot_amount' => 600.00,
                'reason' => 'Demo reason 1',
                'approved_by' => 1,
                'approved_at' => now()->subDays(1),
                'included_in_payroll' => true,
                'payroll_month' => '2026-01',
                'status' => 'active',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
                'deleted_at' => null,
            ],
            [
                'ot_no' => 'OT-0002',
                'employee_id' => 1,
                'attendance_record_id' => 1,
                'ot_date' => now()->subDays(10)->toDateString(),
                'ot_type' => 'general',
                'start_at' => now()->subDays(2),
                'end_at' => now()->subDays(2),
                'ot_hours' => 8.00,
                'ot_rate' => 10.00,
                'ot_amount' => 700.00,
                'reason' => 'Demo reason 2',
                'approved_by' => 1,
                'approved_at' => now()->subDays(2),
                'included_in_payroll' => true,
                'payroll_month' => '2026-02',
                'status' => 'active',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
                'deleted_at' => null,
            ],
            [
                'ot_no' => 'OT-0003',
                'employee_id' => 1,
                'attendance_record_id' => 1,
                'ot_date' => now()->subDays(15)->toDateString(),
                'ot_type' => 'general',
                'start_at' => now()->subDays(3),
                'end_at' => now()->subDays(3),
                'ot_hours' => 8.00,
                'ot_rate' => 10.00,
                'ot_amount' => 800.00,
                'reason' => 'Demo reason 3',
                'approved_by' => 1,
                'approved_at' => now()->subDays(3),
                'included_in_payroll' => true,
                'payroll_month' => '2026-03',
                'status' => 'active',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
                'deleted_at' => null,
            ],
        ];

        foreach ($rows as $row) {
            DB::table('overtime_requests')->updateOrInsert(
                ['ot_no' => $row['ot_no']],
                $row
            );
        }
    }
}
