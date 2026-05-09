<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompetencyTemplateItemSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'competency_template_id' => 1,
                'name' => 'Demo CompetencyTemplateItems 1',
                'description' => 'Demo description 1',
                'weight' => 1.00,
                'sort_order' => 1,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'competency_template_id' => 1,
                'name' => 'Demo CompetencyTemplateItems 2',
                'description' => 'Demo description 2',
                'weight' => 1.00,
                'sort_order' => 2,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'competency_template_id' => 1,
                'name' => 'Demo CompetencyTemplateItems 3',
                'description' => 'Demo description 3',
                'weight' => 1.00,
                'sort_order' => 3,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('competency_template_items')->updateOrInsert(
                ['name' => $row['name']],
                $row
            );
        }
    }
}
