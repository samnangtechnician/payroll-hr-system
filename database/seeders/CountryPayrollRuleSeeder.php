<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountryPayrollRuleSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'country_id' => 1,
                'currency_id' => 1,
                'payroll_cycle' => 'monthly',
                'working_days' => json_encode([]),
                'tax_rule' => json_encode([]),
                'social_contribution_rule' => json_encode([]),
                'bank_export_format' => json_encode([]),
                'payslip_format' => json_encode([]),
                'payslip_language' => 'Demo payslip_language 1',
                'is_active' => true,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'country_id' => 1,
                'currency_id' => 1,
                'payroll_cycle' => 'monthly',
                'working_days' => json_encode([]),
                'tax_rule' => json_encode([]),
                'social_contribution_rule' => json_encode([]),
                'bank_export_format' => json_encode([]),
                'payslip_format' => json_encode([]),
                'payslip_language' => 'Demo payslip_language 2',
                'is_active' => true,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'country_id' => 1,
                'currency_id' => 1,
                'payroll_cycle' => 'monthly',
                'working_days' => json_encode([]),
                'tax_rule' => json_encode([]),
                'social_contribution_rule' => json_encode([]),
                'bank_export_format' => json_encode([]),
                'payslip_format' => json_encode([]),
                'payslip_language' => 'Demo payslip_language 3',
                'is_active' => true,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('country_payroll_rules')->updateOrInsert(
                ['country_id' => $row['country_id']],
                $row
            );
        }
    }
}
