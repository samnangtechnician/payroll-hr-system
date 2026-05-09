<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            ['name' => 'Cambodia',       'iso2' => 'KH', 'iso3' => 'KHM', 'phone_code' => '+855', 'default_currency_code' => 'KHR', 'is_supported_payroll_country' => true],
            ['name' => 'United States',  'iso2' => 'US', 'iso3' => 'USA', 'phone_code' => '+1',   'default_currency_code' => 'USD', 'is_supported_payroll_country' => true],
            ['name' => 'Thailand',       'iso2' => 'TH', 'iso3' => 'THA', 'phone_code' => '+66',  'default_currency_code' => 'THB'],
            ['name' => 'Vietnam',        'iso2' => 'VN', 'iso3' => 'VNM', 'phone_code' => '+84',  'default_currency_code' => 'VND'],
            ['name' => 'Singapore',      'iso2' => 'SG', 'iso3' => 'SGP', 'phone_code' => '+65',  'default_currency_code' => 'SGD'],
            ['name' => 'Malaysia',       'iso2' => 'MY', 'iso3' => 'MYS', 'phone_code' => '+60',  'default_currency_code' => 'MYR'],
            ['name' => 'Indonesia',      'iso2' => 'ID', 'iso3' => 'IDN', 'phone_code' => '+62',  'default_currency_code' => 'IDR'],
            ['name' => 'Philippines',    'iso2' => 'PH', 'iso3' => 'PHL', 'phone_code' => '+63',  'default_currency_code' => 'PHP'],
            ['name' => 'Japan',          'iso2' => 'JP', 'iso3' => 'JPN', 'phone_code' => '+81',  'default_currency_code' => 'JPY'],
            ['name' => 'South Korea',    'iso2' => 'KR', 'iso3' => 'KOR', 'phone_code' => '+82',  'default_currency_code' => 'KRW'],
            ['name' => 'China',          'iso2' => 'CN', 'iso3' => 'CHN', 'phone_code' => '+86',  'default_currency_code' => 'CNY'],
            ['name' => 'Australia',      'iso2' => 'AU', 'iso3' => 'AUS', 'phone_code' => '+61',  'default_currency_code' => 'AUD'],
            ['name' => 'United Kingdom', 'iso2' => 'GB', 'iso3' => 'GBR', 'phone_code' => '+44',  'default_currency_code' => 'GBP'],
            ['name' => 'France',         'iso2' => 'FR', 'iso3' => 'FRA', 'phone_code' => '+33',  'default_currency_code' => 'EUR'],
            ['name' => 'Germany',        'iso2' => 'DE', 'iso3' => 'DEU', 'phone_code' => '+49',  'default_currency_code' => 'EUR'],
            ['name' => 'India',          'iso2' => 'IN', 'iso3' => 'IND', 'phone_code' => '+91',  'default_currency_code' => 'INR'],
            ['name' => 'Canada',         'iso2' => 'CA', 'iso3' => 'CAN', 'phone_code' => '+1',   'default_currency_code' => 'CAD'],
            ['name' => 'Mexico',         'iso2' => 'MX', 'iso3' => 'MEX', 'phone_code' => '+52',  'default_currency_code' => 'MXN'],
            ['name' => 'Brazil',         'iso2' => 'BR', 'iso3' => 'BRA', 'phone_code' => '+55',  'default_currency_code' => 'BRL'],
            ['name' => 'Spain',          'iso2' => 'ES', 'iso3' => 'ESP', 'phone_code' => '+34',  'default_currency_code' => 'EUR'],
        ];

        foreach ($rows as $row) {
            Country::query()->updateOrCreate(
                ['iso2' => $row['iso2']],
                array_merge(['is_active' => true, 'is_supported_payroll_country' => false], $row)
            );
        }
    }
}
