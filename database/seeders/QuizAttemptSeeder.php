<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizAttemptSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'quiz_id' => 1,
                'employee_id' => 1,
                'started_at' => now()->subDays(1),
                'submitted_at' => now()->subDays(1),
                'score' => 1.00,
                'passed' => true,
                'answers' => json_encode([]),
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'quiz_id' => 1,
                'employee_id' => 1,
                'started_at' => now()->subDays(2),
                'submitted_at' => now()->subDays(2),
                'score' => 1.00,
                'passed' => true,
                'answers' => json_encode([]),
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'quiz_id' => 1,
                'employee_id' => 1,
                'started_at' => now()->subDays(3),
                'submitted_at' => now()->subDays(3),
                'score' => 1.00,
                'passed' => true,
                'answers' => json_encode([]),
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('quiz_attempts')->updateOrInsert(
                ['quiz_id' => $row['quiz_id']],
                $row
            );
        }
    }
}
