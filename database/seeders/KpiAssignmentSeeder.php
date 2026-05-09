<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KpiAssignmentSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'kpi_id' => 1,
                'employee_id' => 1,
                'department_id' => 1,
                'review_period_start' => now()->subDays(5)->toDateString(),
                'review_period_end' => now()->subDays(5)->toDateString(),
                'target_value' => 1.00,
                'actual_result' => 1.00,
                'score' => 1.00,
                'rating' => 1.00,
                'evidence_attachment_path' => 'storage/demo/kpi_assignments/evidence_attachment_path_1.txt',
                'reviewed_by' => 1,
                'status' => 'active',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
                'deleted_at' => null,
            ],
            [
                'kpi_id' => 1,
                'employee_id' => 1,
                'department_id' => 1,
                'review_period_start' => now()->subDays(10)->toDateString(),
                'review_period_end' => now()->subDays(10)->toDateString(),
                'target_value' => 1.00,
                'actual_result' => 1.00,
                'score' => 1.00,
                'rating' => 1.00,
                'evidence_attachment_path' => 'storage/demo/kpi_assignments/evidence_attachment_path_2.txt',
                'reviewed_by' => 1,
                'status' => 'active',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
                'deleted_at' => null,
            ],
            [
                'kpi_id' => 1,
                'employee_id' => 1,
                'department_id' => 1,
                'review_period_start' => now()->subDays(15)->toDateString(),
                'review_period_end' => now()->subDays(15)->toDateString(),
                'target_value' => 1.00,
                'actual_result' => 1.00,
                'score' => 1.00,
                'rating' => 1.00,
                'evidence_attachment_path' => 'storage/demo/kpi_assignments/evidence_attachment_path_3.txt',
                'reviewed_by' => 1,
                'status' => 'active',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
                'deleted_at' => null,
            ],
        ];

        foreach ($rows as $row) {
            DB::table('kpi_assignments')->updateOrInsert(
                ['kpi_id' => $row['kpi_id']],
                $row
            );
        }
    }
}
