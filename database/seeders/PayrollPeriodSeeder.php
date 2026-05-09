<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PayrollPeriodSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'company_id' => 1,
                'country_id' => 1,
                'period_code' => 'PERIOD-0001',
                'start_date' => now()->subDays(5)->toDateString(),
                'end_date' => now()->subDays(5)->toDateString(),
                'payment_date' => now()->subDays(5)->toDateString(),
                'status' => 'active',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'company_id' => 1,
                'country_id' => 1,
                'period_code' => 'PERIOD-0002',
                'start_date' => now()->subDays(10)->toDateString(),
                'end_date' => now()->subDays(10)->toDateString(),
                'payment_date' => now()->subDays(10)->toDateString(),
                'status' => 'active',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'company_id' => 1,
                'country_id' => 1,
                'period_code' => 'PERIOD-0003',
                'start_date' => now()->subDays(15)->toDateString(),
                'end_date' => now()->subDays(15)->toDateString(),
                'payment_date' => now()->subDays(15)->toDateString(),
                'status' => 'active',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('payroll_periods')->updateOrInsert(
                ['company_id' => $row['company_id']],
                $row
            );
        }
    }
}
