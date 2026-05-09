<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KpiReviewSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'kpi_assignment_id' => 1,
                'reviewed_by' => 1,
                'review_date' => now()->subDays(5)->toDateString(),
                'progress_percent' => 10.00,
                'score' => 1.00,
                'comment' => 'Demo comment 1',
                'status' => 'active',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'kpi_assignment_id' => 1,
                'reviewed_by' => 1,
                'review_date' => now()->subDays(10)->toDateString(),
                'progress_percent' => 10.00,
                'score' => 1.00,
                'comment' => 'Demo comment 2',
                'status' => 'active',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'kpi_assignment_id' => 1,
                'reviewed_by' => 1,
                'review_date' => now()->subDays(15)->toDateString(),
                'progress_percent' => 10.00,
                'score' => 1.00,
                'comment' => 'Demo comment 3',
                'status' => 'active',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('kpi_reviews')->updateOrInsert(
                ['kpi_assignment_id' => $row['kpi_assignment_id']],
                $row
            );
        }
    }
}
