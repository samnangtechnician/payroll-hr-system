<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OvertimeRateRuleSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'company_id' => 1,
                'country_id' => 1,
                'ot_type' => 'general',
                'rate_multiplier' => 10.00,
                'fixed_hourly_rate' => 10.00,
                'conditions' => json_encode([]),
                'is_active' => true,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'company_id' => 1,
                'country_id' => 1,
                'ot_type' => 'general',
                'rate_multiplier' => 10.00,
                'fixed_hourly_rate' => 10.00,
                'conditions' => json_encode([]),
                'is_active' => true,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'company_id' => 1,
                'country_id' => 1,
                'ot_type' => 'general',
                'rate_multiplier' => 10.00,
                'fixed_hourly_rate' => 10.00,
                'conditions' => json_encode([]),
                'is_active' => true,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('overtime_rate_rules')->updateOrInsert(
                ['company_id' => $row['company_id']],
                $row
            );
        }
    }
}
