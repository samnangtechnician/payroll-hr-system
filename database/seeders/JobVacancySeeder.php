<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobVacancySeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'job_code' => 'JOB-0001',
                'company_id' => 1,
                'department_id' => 1,
                'position_id' => 1,
                'hiring_manager_id' => 1,
                'job_title' => 'Demo job_title 1',
                'location' => 'Demo location 1',
                'employment_type' => 'general',
                'salary_min' => 600.00,
                'salary_max' => 600.00,
                'currency_id' => 1,
                'job_description' => 'Demo job_description 1',
                'requirements' => 'Demo requirements 1',
                'posting_date' => now()->subDays(5)->toDateString(),
                'closing_date' => now()->subDays(5)->toDateString(),
                'free_posting_2026' => true,
                'status' => 'active',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
                'deleted_at' => null,
            ],
            [
                'job_code' => 'JOB-0002',
                'company_id' => 1,
                'department_id' => 1,
                'position_id' => 1,
                'hiring_manager_id' => 1,
                'job_title' => 'Demo job_title 2',
                'location' => 'Demo location 2',
                'employment_type' => 'general',
                'salary_min' => 700.00,
                'salary_max' => 700.00,
                'currency_id' => 1,
                'job_description' => 'Demo job_description 2',
                'requirements' => 'Demo requirements 2',
                'posting_date' => now()->subDays(10)->toDateString(),
                'closing_date' => now()->subDays(10)->toDateString(),
                'free_posting_2026' => true,
                'status' => 'active',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
                'deleted_at' => null,
            ],
            [
                'job_code' => 'JOB-0003',
                'company_id' => 1,
                'department_id' => 1,
                'position_id' => 1,
                'hiring_manager_id' => 1,
                'job_title' => 'Demo job_title 3',
                'location' => 'Demo location 3',
                'employment_type' => 'general',
                'salary_min' => 800.00,
                'salary_max' => 800.00,
                'currency_id' => 1,
                'job_description' => 'Demo job_description 3',
                'requirements' => 'Demo requirements 3',
                'posting_date' => now()->subDays(15)->toDateString(),
                'closing_date' => now()->subDays(15)->toDateString(),
                'free_posting_2026' => true,
                'status' => 'active',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
                'deleted_at' => null,
            ],
        ];

        foreach ($rows as $row) {
            DB::table('job_vacancies')->updateOrInsert(
                ['job_code' => $row['job_code']],
                $row
            );
        }
    }
}
