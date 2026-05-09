<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeBankAccountSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'employee_id' => 1,
                'bank_name' => 'Demo bank_name 1',
                'bank_branch' => 'Demo bank_branch 1',
                'account_name' => 'Demo account_name 1',
                'account_number' => 'Demo account_number 1',
                'swift_code' => 'SWIFT-0001',
                'bank_code' => 'BANK-0001',
                'is_primary' => true,
                'is_active' => true,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'employee_id' => 1,
                'bank_name' => 'Demo bank_name 2',
                'bank_branch' => 'Demo bank_branch 2',
                'account_name' => 'Demo account_name 2',
                'account_number' => 'Demo account_number 2',
                'swift_code' => 'SWIFT-0002',
                'bank_code' => 'BANK-0002',
                'is_primary' => true,
                'is_active' => true,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'employee_id' => 1,
                'bank_name' => 'Demo bank_name 3',
                'bank_branch' => 'Demo bank_branch 3',
                'account_name' => 'Demo account_name 3',
                'account_number' => 'Demo account_number 3',
                'swift_code' => 'SWIFT-0003',
                'bank_code' => 'BANK-0003',
                'is_primary' => true,
                'is_active' => true,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('employee_bank_accounts')->updateOrInsert(
                ['employee_id' => $row['employee_id']],
                $row
            );
        }
    }
}
