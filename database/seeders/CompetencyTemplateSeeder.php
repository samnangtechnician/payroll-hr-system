<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompetencyTemplateSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'company_id' => 1,
                'name' => 'Demo CompetencyTemplates 1',
                'description' => 'Demo description 1',
                'is_active' => true,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'company_id' => 1,
                'name' => 'Demo CompetencyTemplates 2',
                'description' => 'Demo description 2',
                'is_active' => true,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'company_id' => 1,
                'name' => 'Demo CompetencyTemplates 3',
                'description' => 'Demo description 3',
                'is_active' => true,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('competency_templates')->updateOrInsert(
                ['company_id' => $row['company_id'], 'name' => $row['name']],
                $row
            );
        }
    }
}
