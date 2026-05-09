<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentTypeSeeder extends Seeder
{
    public function run(): void
    {
        $companyId = DB::table('companies')->where('company_code', 'DEMO')->value('id');

        $rows = [
            ['name' => 'National ID',         'module' => 'employee',  'requires_expiry_date' => false],
            ['name' => 'Passport',            'module' => 'employee',  'requires_expiry_date' => true],
            ['name' => 'Employment Contract', 'module' => 'employee',  'requires_expiry_date' => true],
            ['name' => 'Resume / CV',         'module' => 'employee',  'requires_expiry_date' => false],
            ['name' => 'Education Diploma',   'module' => 'employee',  'requires_expiry_date' => false],
            ['name' => 'Driving License',     'module' => 'employee',  'requires_expiry_date' => true],
        ];

        foreach ($rows as $row) {
            DB::table('document_types')->updateOrInsert(
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
