<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InterviewScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'candidate_id' => 1,
                'job_vacancy_id' => 1,
                'scheduled_at' => now()->subDays(1),
                'duration_minutes' => 60,
                'location' => 'Demo location 1',
                'meeting_link' => 'Demo meeting_link 1',
                'interviewer_employee_id' => 1,
                'status' => 'active',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'candidate_id' => 1,
                'job_vacancy_id' => 1,
                'scheduled_at' => now()->subDays(2),
                'duration_minutes' => 60,
                'location' => 'Demo location 2',
                'meeting_link' => 'Demo meeting_link 2',
                'interviewer_employee_id' => 1,
                'status' => 'active',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'candidate_id' => 1,
                'job_vacancy_id' => 1,
                'scheduled_at' => now()->subDays(3),
                'duration_minutes' => 60,
                'location' => 'Demo location 3',
                'meeting_link' => 'Demo meeting_link 3',
                'interviewer_employee_id' => 1,
                'status' => 'active',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('interview_schedules')->updateOrInsert(
                ['candidate_id' => $row['candidate_id']],
                $row
            );
        }
    }
}
