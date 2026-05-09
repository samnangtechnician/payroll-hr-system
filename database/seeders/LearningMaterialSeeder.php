<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LearningMaterialSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'learning_course_id' => 1,
                'title' => 'Demo LearningMaterials 1',
                'material_type' => 'general',
                'file_path' => 'storage/demo/learning_materials/file_path_1.txt',
                'external_url' => 'https://example.com/demo/learning_materials/1',
                'sort_order' => 1,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'learning_course_id' => 1,
                'title' => 'Demo LearningMaterials 2',
                'material_type' => 'general',
                'file_path' => 'storage/demo/learning_materials/file_path_2.txt',
                'external_url' => 'https://example.com/demo/learning_materials/2',
                'sort_order' => 2,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'learning_course_id' => 1,
                'title' => 'Demo LearningMaterials 3',
                'material_type' => 'general',
                'file_path' => 'storage/demo/learning_materials/file_path_3.txt',
                'external_url' => 'https://example.com/demo/learning_materials/3',
                'sort_order' => 3,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('learning_materials')->updateOrInsert(
                ['learning_course_id' => $row['learning_course_id']],
                $row
            );
        }
    }
}
