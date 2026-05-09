<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AiUsageLogSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'company_id' => 1,
                'user_id' => 1,
                'module' => 'demo_module_1',
                'use_case' => 'demo_use_case_1',
                'prompt' => 'Demo prompt 1',
                'response_summary' => 'Demo response_summary 1',
                'credit_used' => 110.00,
                'request_payload' => json_encode([]),
                'response_payload' => json_encode([]),
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'company_id' => 1,
                'user_id' => 1,
                'module' => 'demo_module_2',
                'use_case' => 'demo_use_case_2',
                'prompt' => 'Demo prompt 2',
                'response_summary' => 'Demo response_summary 2',
                'credit_used' => 120.00,
                'request_payload' => json_encode([]),
                'response_payload' => json_encode([]),
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'company_id' => 1,
                'user_id' => 1,
                'module' => 'demo_module_3',
                'use_case' => 'demo_use_case_3',
                'prompt' => 'Demo prompt 3',
                'response_summary' => 'Demo response_summary 3',
                'credit_used' => 130.00,
                'request_payload' => json_encode([]),
                'response_payload' => json_encode([]),
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('ai_usage_logs')->updateOrInsert(
                ['company_id' => $row['company_id']],
                $row
            );
        }
    }
}
