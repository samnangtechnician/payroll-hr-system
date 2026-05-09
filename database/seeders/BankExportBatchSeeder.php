<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankExportBatchSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'payroll_run_id' => 1,
                'batch_no' => 'BATCH-0001',
                'bank_name' => 'Demo bank_name 1',
                'file_format' => 'Demo file_format 1',
                'file_path' => 'storage/demo/bank_export_batches/file_path_1.txt',
                'total_amount' => 600.00,
                'total_employees' => 1,
                'generated_by' => 1,
                'generated_at' => now()->subDays(1),
                'status' => 'active',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'payroll_run_id' => 1,
                'batch_no' => 'BATCH-0002',
                'bank_name' => 'Demo bank_name 2',
                'file_format' => 'Demo file_format 2',
                'file_path' => 'storage/demo/bank_export_batches/file_path_2.txt',
                'total_amount' => 700.00,
                'total_employees' => 2,
                'generated_by' => 1,
                'generated_at' => now()->subDays(2),
                'status' => 'active',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'payroll_run_id' => 1,
                'batch_no' => 'BATCH-0003',
                'bank_name' => 'Demo bank_name 3',
                'file_format' => 'Demo file_format 3',
                'file_path' => 'storage/demo/bank_export_batches/file_path_3.txt',
                'total_amount' => 800.00,
                'total_employees' => 3,
                'generated_by' => 1,
                'generated_at' => now()->subDays(3),
                'status' => 'active',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('bank_export_batches')->updateOrInsert(
                ['batch_no' => $row['batch_no']],
                $row
            );
        }
    }
}
