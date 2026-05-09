<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialContributionRuleSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'country_id' => 1,
                'name' => 'Demo SocialContributionRules 1',
                'effective_from' => now()->subDays(5)->toDateString(),
                'effective_to' => now()->subDays(5)->toDateString(),
                'employee_rate' => 10.00,
                'employer_rate' => 10.00,
                'ceiling_amount' => 600.00,
                'settings' => json_encode([]),
                'is_active' => true,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'country_id' => 1,
                'name' => 'Demo SocialContributionRules 2',
                'effective_from' => now()->subDays(10)->toDateString(),
                'effective_to' => now()->subDays(10)->toDateString(),
                'employee_rate' => 10.00,
                'employer_rate' => 10.00,
                'ceiling_amount' => 700.00,
                'settings' => json_encode([]),
                'is_active' => true,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'country_id' => 1,
                'name' => 'Demo SocialContributionRules 3',
                'effective_from' => now()->subDays(15)->toDateString(),
                'effective_to' => now()->subDays(15)->toDateString(),
                'employee_rate' => 10.00,
                'employer_rate' => 10.00,
                'ceiling_amount' => 800.00,
                'settings' => json_encode([]),
                'is_active' => true,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('social_contribution_rules')->updateOrInsert(
                ['name' => $row['name']],
                $row
            );
        }
    }
}
