<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppraisalScoreSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'appraisal_record_id' => 1,
                'score_type' => 'general',
                'criteria_name' => 'Demo criteria_name 1',
                'weight' => 1.00,
                'score' => 1.00,
                'comment' => 'Demo comment 1',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'appraisal_record_id' => 1,
                'score_type' => 'general',
                'criteria_name' => 'Demo criteria_name 2',
                'weight' => 1.00,
                'score' => 1.00,
                'comment' => 'Demo comment 2',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'appraisal_record_id' => 1,
                'score_type' => 'general',
                'criteria_name' => 'Demo criteria_name 3',
                'weight' => 1.00,
                'score' => 1.00,
                'comment' => 'Demo comment 3',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('appraisal_scores')->updateOrInsert(
                ['appraisal_record_id' => $row['appraisal_record_id']],
                $row
            );
        }
    }
}
