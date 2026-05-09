<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppraisalRecordSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'appraisal_no' => 'APPRAISAL-0001',
                'appraisal_cycle_id' => 1,
                'employee_id' => 1,
                'reviewer_id' => 1,
                'department_id' => 1,
                'position_id' => 1,
                'kpi_score' => 1.00,
                'competency_score' => 1.00,
                'attendance_score' => 1.00,
                'behavior_score' => 1.00,
                'final_rating' => 1.00,
                'recommendation' => 'Demo recommendation 1',
                'development_plan' => 'Demo development_plan 1',
                'status' => 'active',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
                'deleted_at' => null,
            ],
            [
                'appraisal_no' => 'APPRAISAL-0002',
                'appraisal_cycle_id' => 1,
                'employee_id' => 1,
                'reviewer_id' => 1,
                'department_id' => 1,
                'position_id' => 1,
                'kpi_score' => 1.00,
                'competency_score' => 1.00,
                'attendance_score' => 1.00,
                'behavior_score' => 1.00,
                'final_rating' => 1.00,
                'recommendation' => 'Demo recommendation 2',
                'development_plan' => 'Demo development_plan 2',
                'status' => 'active',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
                'deleted_at' => null,
            ],
            [
                'appraisal_no' => 'APPRAISAL-0003',
                'appraisal_cycle_id' => 1,
                'employee_id' => 1,
                'reviewer_id' => 1,
                'department_id' => 1,
                'position_id' => 1,
                'kpi_score' => 1.00,
                'competency_score' => 1.00,
                'attendance_score' => 1.00,
                'behavior_score' => 1.00,
                'final_rating' => 1.00,
                'recommendation' => 'Demo recommendation 3',
                'development_plan' => 'Demo development_plan 3',
                'status' => 'active',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
                'deleted_at' => null,
            ],
        ];

        foreach ($rows as $row) {
            DB::table('appraisal_records')->updateOrInsert(
                ['appraisal_no' => $row['appraisal_no']],
                $row
            );
        }
    }
}
