<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AiCreditAccountSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'company_id' => 1,
                'billing_month' => '2026-01',
                'monthly_credit_amount' => 600.00,
                'used_credit_amount' => 600.00,
                'remaining_credit_amount' => 600.00,
                'currency_id' => 1,
                'limits' => json_encode([]),
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'company_id' => 1,
                'billing_month' => '2026-02',
                'monthly_credit_amount' => 700.00,
                'used_credit_amount' => 700.00,
                'remaining_credit_amount' => 700.00,
                'currency_id' => 1,
                'limits' => json_encode([]),
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'company_id' => 1,
                'billing_month' => '2026-03',
                'monthly_credit_amount' => 800.00,
                'used_credit_amount' => 800.00,
                'remaining_credit_amount' => 800.00,
                'currency_id' => 1,
                'limits' => json_encode([]),
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('ai_credit_accounts')->updateOrInsert(
                ['company_id' => $row['company_id']],
                $row
            );
        }
    }
}
