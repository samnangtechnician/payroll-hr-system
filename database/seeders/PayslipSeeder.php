<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PayslipSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'payroll_run_item_id' => 1,
                'payslip_no' => 'PAYSLIP-0001',
                'file_path' => 'storage/demo/payslips/file_path_1.txt',
                'released_at' => now()->subDays(1),
                'downloaded_at' => now()->subDays(1),
                'status' => 'active',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'payroll_run_item_id' => 1,
                'payslip_no' => 'PAYSLIP-0002',
                'file_path' => 'storage/demo/payslips/file_path_2.txt',
                'released_at' => now()->subDays(2),
                'downloaded_at' => now()->subDays(2),
                'status' => 'active',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'payroll_run_item_id' => 1,
                'payslip_no' => 'PAYSLIP-0003',
                'file_path' => 'storage/demo/payslips/file_path_3.txt',
                'released_at' => now()->subDays(3),
                'downloaded_at' => now()->subDays(3),
                'status' => 'active',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('payslips')->updateOrInsert(
                ['payslip_no' => $row['payslip_no']],
                $row
            );
        }
    }
}
