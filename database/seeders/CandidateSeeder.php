<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CandidateSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'job_vacancy_id' => 1,
                'candidate_no' => 'CANDIDATE-0001',
                'first_name' => 'Demo first_name 1',
                'last_name' => 'Demo last_name 1',
                'email' => 'candidates_1@payroll-hr.local',
                'phone' => '+85512000001',
                'address' => 'Demo address 1',
                'source' => 'Demo source 1',
                'expected_salary' => 600.00,
                'resume_summary' => 'Demo resume_summary 1',
                'pipeline_status' => 'Demo pipeline_status 1',
                'status' => 'active',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
                'deleted_at' => null,
            ],
            [
                'job_vacancy_id' => 1,
                'candidate_no' => 'CANDIDATE-0002',
                'first_name' => 'Demo first_name 2',
                'last_name' => 'Demo last_name 2',
                'email' => 'candidates_2@payroll-hr.local',
                'phone' => '+85512000002',
                'address' => 'Demo address 2',
                'source' => 'Demo source 2',
                'expected_salary' => 700.00,
                'resume_summary' => 'Demo resume_summary 2',
                'pipeline_status' => 'Demo pipeline_status 2',
                'status' => 'active',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
                'deleted_at' => null,
            ],
            [
                'job_vacancy_id' => 1,
                'candidate_no' => 'CANDIDATE-0003',
                'first_name' => 'Demo first_name 3',
                'last_name' => 'Demo last_name 3',
                'email' => 'candidates_3@payroll-hr.local',
                'phone' => '+85512000003',
                'address' => 'Demo address 3',
                'source' => 'Demo source 3',
                'expected_salary' => 800.00,
                'resume_summary' => 'Demo resume_summary 3',
                'pipeline_status' => 'Demo pipeline_status 3',
                'status' => 'active',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
                'deleted_at' => null,
            ],
        ];

        foreach ($rows as $row) {
            DB::table('candidates')->updateOrInsert(
                ['candidate_no' => $row['candidate_no']],
                $row
            );
        }
    }
}
