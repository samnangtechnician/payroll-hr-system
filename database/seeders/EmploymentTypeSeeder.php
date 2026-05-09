<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmploymentTypeSeeder extends Seeder
{
    public function run(): void
    {
        $companyId = DB::table('companies')->where('company_code', 'DEMO')->value('id');

        $rows = [
            ['name' => 'Full-time',  'description' => 'Full-time employee'],
            ['name' => 'Part-time',  'description' => 'Part-time employee'],
            ['name' => 'Contract',   'description' => 'Fixed-term contract'],
            ['name' => 'Internship', 'description' => 'Intern / apprentice'],
        ];

        foreach ($rows as $row) {
            DB::table('employment_types')->updateOrInsert(
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
