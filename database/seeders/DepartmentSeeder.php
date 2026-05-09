<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $companyId = DB::table('companies')->where('company_code', 'DEMO')->value('id');
        $branchId = DB::table('branches')->where('company_id', $companyId)->where('branch_code', 'HQ')->value('id');

        $rows = [
            ['department_code' => 'HR',    'name' => 'Human Resources'],
            ['department_code' => 'FIN',   'name' => 'Finance & Accounting'],
            ['department_code' => 'IT',    'name' => 'Information Technology'],
            ['department_code' => 'OPS',   'name' => 'Operations'],
            ['department_code' => 'SALES', 'name' => 'Sales & Marketing'],
        ];

        foreach ($rows as $row) {
            DB::table('departments')->updateOrInsert(
                ['company_id' => $companyId, 'department_code' => $row['department_code']],
                array_merge($row, [
                    'company_id' => $companyId,
                    'branch_id' => $branchId,
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }
}
