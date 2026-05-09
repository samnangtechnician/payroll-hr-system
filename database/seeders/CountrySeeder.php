<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            ['name' => 'Cambodia',       'iso2' => 'KH', 'iso3' => 'KHM', 'phone_code' => '+855', 'default_currency_code' => 'KHR', 'is_supported_payroll_country' => true],
            ['name' => 'United States',  'iso2' => 'US', 'iso3' => 'USA', 'phone_code' => '+1',   'default_currency_code' => 'USD', 'is_supported_payroll_country' => true],
            ['name' => 'Thailand',       'iso2' => 'TH', 'iso3' => 'THA', 'phone_code' => '+66',  'default_currency_code' => 'THB', 'is_supported_payroll_country' => true],
            ['name' => 'Vietnam',        'iso2' => 'VN', 'iso3' => 'VNM', 'phone_code' => '+84',  'default_currency_code' => 'VND', 'is_supported_payroll_country' => true],
            ['name' => 'Singapore',      'iso2' => 'SG', 'iso3' => 'SGP', 'phone_code' => '+65',  'default_currency_code' => 'SGD', 'is_supported_payroll_country' => true],
            ['name' => 'Malaysia',       'iso2' => 'MY', 'iso3' => 'MYS', 'phone_code' => '+60',  'default_currency_code' => 'MYR', 'is_supported_payroll_country' => true],
            ['name' => 'Indonesia',      'iso2' => 'ID', 'iso3' => 'IDN', 'phone_code' => '+62',  'default_currency_code' => 'IDR', 'is_supported_payroll_country' => true],
            ['name' => 'Philippines',    'iso2' => 'PH', 'iso3' => 'PHL', 'phone_code' => '+63',  'default_currency_code' => 'PHP', 'is_supported_payroll_country' => true],
            ['name' => 'Japan',          'iso2' => 'JP', 'iso3' => 'JPN', 'phone_code' => '+81',  'default_currency_code' => 'JPY', 'is_supported_payroll_country' => false],
            ['name' => 'South Korea',    'iso2' => 'KR', 'iso3' => 'KOR', 'phone_code' => '+82',  'default_currency_code' => 'KRW', 'is_supported_payroll_country' => false],
            ['name' => 'China',          'iso2' => 'CN', 'iso3' => 'CHN', 'phone_code' => '+86',  'default_currency_code' => 'CNY', 'is_supported_payroll_country' => false],
            ['name' => 'India',          'iso2' => 'IN', 'iso3' => 'IND', 'phone_code' => '+91',  'default_currency_code' => 'INR', 'is_supported_payroll_country' => false],
            ['name' => 'Australia',      'iso2' => 'AU', 'iso3' => 'AUS', 'phone_code' => '+61',  'default_currency_code' => 'AUD', 'is_supported_payroll_country' => false],
            ['name' => 'United Kingdom', 'iso2' => 'GB', 'iso3' => 'GBR', 'phone_code' => '+44',  'default_currency_code' => 'GBP', 'is_supported_payroll_country' => false],
            ['name' => 'Canada',         'iso2' => 'CA', 'iso3' => 'CAN', 'phone_code' => '+1',   'default_currency_code' => 'CAD', 'is_supported_payroll_country' => false],
            ['name' => 'France',         'iso2' => 'FR', 'iso3' => 'FRA', 'phone_code' => '+33',  'default_currency_code' => 'EUR', 'is_supported_payroll_country' => false],
            ['name' => 'Germany',        'iso2' => 'DE', 'iso3' => 'DEU', 'phone_code' => '+49',  'default_currency_code' => 'EUR', 'is_supported_payroll_country' => false],
            ['name' => 'Laos',           'iso2' => 'LA', 'iso3' => 'LAO', 'phone_code' => '+856', 'default_currency_code' => 'USD', 'is_supported_payroll_country' => false],
            ['name' => 'Myanmar',        'iso2' => 'MM', 'iso3' => 'MMR', 'phone_code' => '+95',  'default_currency_code' => 'USD', 'is_supported_payroll_country' => false],
            ['name' => 'Brunei',         'iso2' => 'BN', 'iso3' => 'BRN', 'phone_code' => '+673', 'default_currency_code' => 'SGD', 'is_supported_payroll_country' => false],
        ];

        foreach ($rows as $row) {
            DB::table('countries')->updateOrInsert(
                ['iso2' => $row['iso2']],
                array_merge($row, [
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }
}
