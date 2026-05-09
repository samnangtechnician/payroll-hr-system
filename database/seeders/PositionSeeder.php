<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    public function run(): void
    {
        $companyId = DB::table('companies')->where('company_code', 'DEMO')->value('id');

        $hr = DB::table('departments')->where('company_id', $companyId)->where('department_code', 'HR')->value('id');
        $it = DB::table('departments')->where('company_id', $companyId)->where('department_code', 'IT')->value('id');
        $fin = DB::table('departments')->where('company_id', $companyId)->where('department_code', 'FIN')->value('id');
        $ops = DB::table('departments')->where('company_id', $companyId)->where('department_code', 'OPS')->value('id');

        $rows = [
            ['department_id' => $ops, 'position_code' => 'CEO',      'title' => 'Chief Executive Officer', 'level' => 'C-Level', 'is_managerial' => true],
            ['department_id' => $hr,  'position_code' => 'HR-MGR',   'title' => 'HR Manager',              'level' => 'Manager', 'is_managerial' => true],
            ['department_id' => $it,  'position_code' => 'SE',       'title' => 'Software Engineer',       'level' => 'L2',      'is_managerial' => false],
            ['department_id' => $fin, 'position_code' => 'STAFF',    'title' => 'Staff Accountant',        'level' => 'L1',      'is_managerial' => false],
        ];

        foreach ($rows as $row) {
            DB::table('positions')->updateOrInsert(
                ['company_id' => $companyId, 'position_code' => $row['position_code']],
                array_merge($row, [
                    'company_id' => $companyId,
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }
}
