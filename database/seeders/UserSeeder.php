<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $companyId = DB::table('companies')->where('company_code', 'DEMO')->value('id');

        $rows = [
            ['email' => 'admin@payroll-hr.local',   'name' => 'System Administrator', 'username' => 'admin'],
            ['email' => 'hr@payroll-hr.local',      'name' => 'HR Manager',           'username' => 'hr'],
            ['email' => 'finance@payroll-hr.local', 'name' => 'Finance Manager',      'username' => 'finance'],
        ];

        foreach ($rows as $row) {
            DB::table('users')->updateOrInsert(
                ['email' => $row['email']],
                array_merge($row, [
                    'company_id' => $companyId,
                    'password' => Hash::make('password'),
                    'is_active' => true,
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }
}
