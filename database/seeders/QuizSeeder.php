<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'learning_course_id' => 1,
                'title' => 'Demo Quizzes 1',
                'passing_score' => 1.00,
                'time_limit_minutes' => 60,
                'is_active' => true,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'learning_course_id' => 1,
                'title' => 'Demo Quizzes 2',
                'passing_score' => 1.00,
                'time_limit_minutes' => 60,
                'is_active' => true,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'learning_course_id' => 1,
                'title' => 'Demo Quizzes 3',
                'passing_score' => 1.00,
                'time_limit_minutes' => 60,
                'is_active' => true,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('quizzes')->updateOrInsert(
                ['learning_course_id' => $row['learning_course_id']],
                $row
            );
        }
    }
}
