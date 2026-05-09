<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InterviewFeedbackSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'interview_schedule_id' => 1,
                'reviewer_employee_id' => 1,
                'score' => 1.00,
                'feedback' => 'Demo feedback 1',
                'recommendation' => 'Demo recommendation 1',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'interview_schedule_id' => 1,
                'reviewer_employee_id' => 1,
                'score' => 1.00,
                'feedback' => 'Demo feedback 2',
                'recommendation' => 'Demo recommendation 2',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'interview_schedule_id' => 1,
                'reviewer_employee_id' => 1,
                'score' => 1.00,
                'feedback' => 'Demo feedback 3',
                'recommendation' => 'Demo recommendation 3',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('interview_feedback')->updateOrInsert(
                ['interview_schedule_id' => $row['interview_schedule_id']],
                $row
            );
        }
    }
}
