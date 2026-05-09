<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    public function run(): void
    {
        $companyId = DB::table('companies')->where('company_code', 'DEMO')->value('id');
        $countryId = DB::table('countries')->where('iso2', 'KH')->value('id');

        $rows = [
            [
                'company_id' => $companyId,
                'country_id' => $countryId,
                'branch_code' => 'HQ',
                'name' => 'Head Office',
                'address' => '#123, St. 271, Phnom Penh',
                'phone' => '+855 12 111 111',
                'email' => 'hq@payroll-hr.local',
                'is_head_office' => true,
                'is_active' => true,
            ],
            [
                'company_id' => $companyId,
                'country_id' => $countryId,
                'branch_code' => 'BR1',
                'name' => 'Branch One',
                'address' => 'Siem Reap',
                'phone' => '+855 12 222 222',
                'email' => 'br1@payroll-hr.local',
                'is_head_office' => false,
                'is_active' => true,
            ],
            [
                'company_id' => $companyId,
                'country_id' => $countryId,
                'branch_code' => 'BR2',
                'name' => 'Branch Two',
                'address' => 'Battambang',
                'phone' => '+855 12 333 333',
                'email' => 'br2@payroll-hr.local',
                'is_head_office' => false,
                'is_active' => true,
            ],
        ];

        foreach ($rows as $row) {
            DB::table('branches')->updateOrInsert(
                ['company_id' => $row['company_id'], 'branch_code' => $row['branch_code']],
                array_merge($row, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }
}
