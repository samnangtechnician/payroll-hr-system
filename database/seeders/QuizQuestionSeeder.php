<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizQuestionSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'quiz_id' => 1,
                'question' => 'Demo question 1',
                'question_type' => 'general',
                'options' => json_encode([]),
                'correct_answer' => json_encode([]),
                'points' => 1.00,
                'sort_order' => 1,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'quiz_id' => 1,
                'question' => 'Demo question 2',
                'question_type' => 'general',
                'options' => json_encode([]),
                'correct_answer' => json_encode([]),
                'points' => 1.00,
                'sort_order' => 2,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'quiz_id' => 1,
                'question' => 'Demo question 3',
                'question_type' => 'general',
                'options' => json_encode([]),
                'correct_answer' => json_encode([]),
                'points' => 1.00,
                'sort_order' => 3,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('quiz_questions')->updateOrInsert(
                ['quiz_id' => $row['quiz_id']],
                $row
            );
        }
    }
}
