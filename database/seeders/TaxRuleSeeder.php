<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaxRuleSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'country_id' => 1,
                'name' => 'Demo TaxRules 1',
                'effective_from' => now()->subDays(5)->toDateString(),
                'effective_to' => now()->subDays(5)->toDateString(),
                'brackets' => json_encode([]),
                'settings' => json_encode([]),
                'is_active' => true,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'country_id' => 1,
                'name' => 'Demo TaxRules 2',
                'effective_from' => now()->subDays(10)->toDateString(),
                'effective_to' => now()->subDays(10)->toDateString(),
                'brackets' => json_encode([]),
                'settings' => json_encode([]),
                'is_active' => true,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'country_id' => 1,
                'name' => 'Demo TaxRules 3',
                'effective_from' => now()->subDays(15)->toDateString(),
                'effective_to' => now()->subDays(15)->toDateString(),
                'brackets' => json_encode([]),
                'settings' => json_encode([]),
                'is_active' => true,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('tax_rules')->updateOrInsert(
                ['name' => $row['name']],
                $row
            );
        }
    }
}
