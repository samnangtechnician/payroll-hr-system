<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LearningAssignmentSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'learning_course_id' => 1,
                'employee_id' => 1,
                'assigned_date' => now()->subDays(5)->toDateString(),
                'due_date' => now()->subDays(5)->toDateString(),
                'started_at' => now()->subDays(1),
                'completed_at' => now()->subDays(1),
                'status' => 'active',
                'progress_percent' => 10.00,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'learning_course_id' => 1,
                'employee_id' => 1,
                'assigned_date' => now()->subDays(10)->toDateString(),
                'due_date' => now()->subDays(10)->toDateString(),
                'started_at' => now()->subDays(2),
                'completed_at' => now()->subDays(2),
                'status' => 'active',
                'progress_percent' => 10.00,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'learning_course_id' => 1,
                'employee_id' => 1,
                'assigned_date' => now()->subDays(15)->toDateString(),
                'due_date' => now()->subDays(15)->toDateString(),
                'started_at' => now()->subDays(3),
                'completed_at' => now()->subDays(3),
                'status' => 'active',
                'progress_percent' => 10.00,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('learning_assignments')->updateOrInsert(
                ['learning_course_id' => $row['learning_course_id']],
                $row
            );
        }
    }
}
