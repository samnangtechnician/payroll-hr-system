<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PublicHolidaySeeder extends Seeder
{
    public function run(): void
    {
        $companyId = DB::table('companies')->where('company_code', 'DEMO')->value('id');
        $countryId = DB::table('countries')->where('iso2', 'KH')->value('id');

        // Cambodia public holidays — 2026 reference dates.
        $rows = [
            ['name' => "International New Year's Day", 'holiday_date' => '2026-01-01'],
            ['name' => 'Victory over Genocide Day',    'holiday_date' => '2026-01-07'],
            ['name' => 'International Women\'s Day',   'holiday_date' => '2026-03-08'],
            ['name' => 'Khmer New Year (Day 1)',       'holiday_date' => '2026-04-14'],
            ['name' => 'Khmer New Year (Day 2)',       'holiday_date' => '2026-04-15'],
            ['name' => 'Khmer New Year (Day 3)',       'holiday_date' => '2026-04-16'],
            ['name' => 'International Labour Day',     'holiday_date' => '2026-05-01'],
            ['name' => 'Royal Birthday HM the King',   'holiday_date' => '2026-05-14'],
            ['name' => 'International Children\'s Day', 'holiday_date' => '2026-06-01'],
            ['name' => 'Constitution Day',             'holiday_date' => '2026-09-24'],
            ['name' => 'Pchum Ben (Day 1)',            'holiday_date' => '2026-10-09'],
            ['name' => 'Pchum Ben (Day 2)',            'holiday_date' => '2026-10-10'],
            ['name' => 'Pchum Ben (Day 3)',            'holiday_date' => '2026-10-11'],
            ['name' => 'King\'s Coronation Day',       'holiday_date' => '2026-10-29'],
            ['name' => 'Independence Day',             'holiday_date' => '2026-11-09'],
            ['name' => 'Water Festival (Day 1)',       'holiday_date' => '2026-11-23'],
            ['name' => 'Water Festival (Day 2)',       'holiday_date' => '2026-11-24'],
            ['name' => 'Water Festival (Day 3)',       'holiday_date' => '2026-11-25'],
        ];

        foreach ($rows as $row) {
            DB::table('public_holidays')->updateOrInsert(
                ['company_id' => $companyId, 'holiday_date' => $row['holiday_date'], 'name' => $row['name']],
                array_merge($row, [
                    'company_id' => $companyId,
                    'country_id' => $countryId,
                    'is_recurring' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }
}
