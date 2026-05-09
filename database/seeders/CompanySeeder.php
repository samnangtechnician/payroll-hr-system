<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        $countryId = DB::table('countries')->where('iso2', 'KH')->value('id');
        $currencyId = DB::table('currencies')->where('code', 'USD')->value('id');

        $rows = [
            [
                'country_id' => $countryId,
                'currency_id' => $currencyId,
                'company_code' => 'DEMO',
                'name' => 'Demo Payroll Co., Ltd.',
                'legal_name' => 'Demo Payroll Company Limited',
                'address' => '#123, St. 271, Sangkat Toul Tom Pong, Khan Chamkamon, Phnom Penh',
                'phone' => '+855 23 123 456',
                'email' => 'info@demo-payroll.local',
                'website' => 'https://demo-payroll.local',
                'tax_registration_no' => 'TIN-1000001',
                'business_registration_no' => 'BR-1000001',
                'fiscal_year_start_month' => '1',
                'payroll_cycle' => 'monthly',
                'working_days' => json_encode(['mon', 'tue', 'wed', 'thu', 'fri']),
                'is_active' => true,
            ],
        ];

        foreach ($rows as $row) {
            DB::table('companies')->updateOrInsert(
                ['company_code' => $row['company_code']],
                array_merge($row, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }
}
