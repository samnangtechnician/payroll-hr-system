<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeContractSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'employee_id' => 1,
                'contract_type_id' => 1,
                'contract_no' => 'CONTRACT-0001',
                'start_date' => now()->subDays(5)->toDateString(),
                'end_date' => now()->subDays(5)->toDateString(),
                'salary_amount' => 600.00,
                'currency_id' => 1,
                'file_path' => 'storage/demo/employee_contracts/file_path_1.txt',
                'status' => 'active',
                'remarks' => 'Demo remarks 1',
                'created_by' => 1,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
                'deleted_at' => null,
            ],
            [
                'employee_id' => 1,
                'contract_type_id' => 1,
                'contract_no' => 'CONTRACT-0002',
                'start_date' => now()->subDays(10)->toDateString(),
                'end_date' => now()->subDays(10)->toDateString(),
                'salary_amount' => 700.00,
                'currency_id' => 1,
                'file_path' => 'storage/demo/employee_contracts/file_path_2.txt',
                'status' => 'active',
                'remarks' => 'Demo remarks 2',
                'created_by' => 1,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
                'deleted_at' => null,
            ],
            [
                'employee_id' => 1,
                'contract_type_id' => 1,
                'contract_no' => 'CONTRACT-0003',
                'start_date' => now()->subDays(15)->toDateString(),
                'end_date' => now()->subDays(15)->toDateString(),
                'salary_amount' => 800.00,
                'currency_id' => 1,
                'file_path' => 'storage/demo/employee_contracts/file_path_3.txt',
                'status' => 'active',
                'remarks' => 'Demo remarks 3',
                'created_by' => 1,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
                'deleted_at' => null,
            ],
        ];

        foreach ($rows as $row) {
            DB::table('employee_contracts')->updateOrInsert(
                ['employee_id' => $row['employee_id']],
                $row
            );
        }
    }
}
