<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LearningCourseSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'company_id' => 1,
                'learning_category_id' => 1,
                'course_code' => 'COURSE-0001',
                'title' => 'Demo LearningCourses 1',
                'description' => 'Demo description 1',
                'assigned_department_id' => 1,
                'due_date' => now()->subDays(5)->toDateString(),
                'quiz_required' => true,
                'certificate_required' => true,
                'status' => 'active',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
                'deleted_at' => null,
            ],
            [
                'company_id' => 1,
                'learning_category_id' => 1,
                'course_code' => 'COURSE-0002',
                'title' => 'Demo LearningCourses 2',
                'description' => 'Demo description 2',
                'assigned_department_id' => 1,
                'due_date' => now()->subDays(10)->toDateString(),
                'quiz_required' => true,
                'certificate_required' => true,
                'status' => 'active',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
                'deleted_at' => null,
            ],
            [
                'company_id' => 1,
                'learning_category_id' => 1,
                'course_code' => 'COURSE-0003',
                'title' => 'Demo LearningCourses 3',
                'description' => 'Demo description 3',
                'assigned_department_id' => 1,
                'due_date' => now()->subDays(15)->toDateString(),
                'quiz_required' => true,
                'certificate_required' => true,
                'status' => 'active',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
                'deleted_at' => null,
            ],
        ];

        foreach ($rows as $row) {
            DB::table('learning_courses')->updateOrInsert(
                ['company_id' => $row['company_id']],
                $row
            );
        }
    }
}
