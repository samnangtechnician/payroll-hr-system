<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $companyId = DB::table('companies')->where('company_code', 'DEMO')->value('id');

        $rows = [
            ['name' => 'Admin',           'description' => 'Full system administrator',   'is_system' => true],
            ['name' => 'HR Manager',      'description' => 'Human resources manager',     'is_system' => true],
            ['name' => 'Finance Manager', 'description' => 'Finance and payroll manager', 'is_system' => true],
            ['name' => 'Branch Manager',  'description' => 'Branch-level manager',        'is_system' => true],
            ['name' => 'Employee',        'description' => 'Regular employee',            'is_system' => true],
        ];

        foreach ($rows as $row) {
            DB::table('roles')->updateOrInsert(
                ['name' => $row['name'], 'guard_name' => 'web'],
                array_merge($row, [
                    'company_id' => $companyId,
                    'guard_name' => 'web',
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }
}
