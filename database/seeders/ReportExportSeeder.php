<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportExportSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'company_id' => 1,
                'requested_by' => 1,
                'report_type' => 'general',
                'format' => 'csv',
                'filters' => json_encode([]),
                'file_path' => 'storage/demo/report_exports/file_path_1.txt',
                'status' => 'active',
                'generated_at' => now()->subDays(1),
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'company_id' => 1,
                'requested_by' => 1,
                'report_type' => 'general',
                'format' => 'csv',
                'filters' => json_encode([]),
                'file_path' => 'storage/demo/report_exports/file_path_2.txt',
                'status' => 'active',
                'generated_at' => now()->subDays(2),
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'company_id' => 1,
                'requested_by' => 1,
                'report_type' => 'general',
                'format' => 'csv',
                'filters' => json_encode([]),
                'file_path' => 'storage/demo/report_exports/file_path_3.txt',
                'status' => 'active',
                'generated_at' => now()->subDays(3),
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('report_exports')->updateOrInsert(
                ['company_id' => $row['company_id']],
                $row
            );
        }
    }
}
