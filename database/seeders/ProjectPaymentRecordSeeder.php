<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectPaymentRecordSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'project_payment_no' => 'PROJECT_PAYMENT-0001',
                'employee_id' => 1,
                'project_id' => 1,
                'task_or_work_type' => 'general',
                'work_date' => now()->subDays(5)->toDateString(),
                'approved_hours' => 8.00,
                'rate' => 10.00,
                'payment_amount' => 600.00,
                'currency_id' => 1,
                'approved_by' => 1,
                'approved_at' => now()->subDays(5)->toDateString(),
                'payroll_month' => '2026-01',
                'included_in_payroll' => true,
                'status' => 'active',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
                'deleted_at' => null,
            ],
            [
                'project_payment_no' => 'PROJECT_PAYMENT-0002',
                'employee_id' => 1,
                'project_id' => 1,
                'task_or_work_type' => 'general',
                'work_date' => now()->subDays(10)->toDateString(),
                'approved_hours' => 8.00,
                'rate' => 10.00,
                'payment_amount' => 700.00,
                'currency_id' => 1,
                'approved_by' => 1,
                'approved_at' => now()->subDays(10)->toDateString(),
                'payroll_month' => '2026-02',
                'included_in_payroll' => true,
                'status' => 'active',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
                'deleted_at' => null,
            ],
            [
                'project_payment_no' => 'PROJECT_PAYMENT-0003',
                'employee_id' => 1,
                'project_id' => 1,
                'task_or_work_type' => 'general',
                'work_date' => now()->subDays(15)->toDateString(),
                'approved_hours' => 8.00,
                'rate' => 10.00,
                'payment_amount' => 800.00,
                'currency_id' => 1,
                'approved_by' => 1,
                'approved_at' => now()->subDays(15)->toDateString(),
                'payroll_month' => '2026-03',
                'included_in_payroll' => true,
                'status' => 'active',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
                'deleted_at' => null,
            ],
        ];

        foreach ($rows as $row) {
            DB::table('project_payment_records')->updateOrInsert(
                ['project_payment_no' => $row['project_payment_no']],
                $row
            );
        }
    }
}
