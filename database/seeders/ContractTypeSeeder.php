<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContractTypeSeeder extends Seeder
{
    public function run(): void
    {
        $companyId = DB::table('companies')->where('company_code', 'DEMO')->value('id');

        $rows = [
            ['name' => 'Probation',   'default_months' => 3,  'description' => 'Probation contract'],
            ['name' => 'Fixed Term',  'default_months' => 12, 'description' => 'Fixed-term contract'],
            ['name' => 'Permanent',   'default_months' => 0,  'description' => 'Permanent / undefined-term contract'],
            ['name' => 'Internship',  'default_months' => 3,  'description' => 'Internship contract'],
        ];

        foreach ($rows as $row) {
            DB::table('contract_types')->updateOrInsert(
                ['company_id' => $companyId, 'name' => $row['name']],
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
