<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppraisalCycleSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'company_id' => 1,
                'name' => 'Demo AppraisalCycles 1',
                'period_start' => now()->subDays(5)->toDateString(),
                'period_end' => now()->subDays(5)->toDateString(),
                'submission_deadline' => now()->subDays(5)->toDateString(),
                'status' => 'active',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'company_id' => 1,
                'name' => 'Demo AppraisalCycles 2',
                'period_start' => now()->subDays(10)->toDateString(),
                'period_end' => now()->subDays(10)->toDateString(),
                'submission_deadline' => now()->subDays(10)->toDateString(),
                'status' => 'active',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'company_id' => 1,
                'name' => 'Demo AppraisalCycles 3',
                'period_start' => now()->subDays(15)->toDateString(),
                'period_end' => now()->subDays(15)->toDateString(),
                'submission_deadline' => now()->subDays(15)->toDateString(),
                'status' => 'active',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('appraisal_cycles')->updateOrInsert(
                ['company_id' => $row['company_id'], 'name' => $row['name']],
                $row
            );
        }
    }
}
