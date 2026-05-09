<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PolicyAcknowledgementSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'employee_id' => 1,
                'document_type_id' => 1,
                'policy_title' => 'Demo policy_title 1',
                'policy_file_path' => 'storage/demo/policy_acknowledgements/policy_file_path_1.txt',
                'acknowledged_at' => now()->subDays(1),
                'status' => 'active',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'employee_id' => 1,
                'document_type_id' => 1,
                'policy_title' => 'Demo policy_title 2',
                'policy_file_path' => 'storage/demo/policy_acknowledgements/policy_file_path_2.txt',
                'acknowledged_at' => now()->subDays(2),
                'status' => 'active',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'employee_id' => 1,
                'document_type_id' => 1,
                'policy_title' => 'Demo policy_title 3',
                'policy_file_path' => 'storage/demo/policy_acknowledgements/policy_file_path_3.txt',
                'acknowledged_at' => now()->subDays(3),
                'status' => 'active',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('policy_acknowledgements')->updateOrInsert(
                ['employee_id' => $row['employee_id']],
                $row
            );
        }
    }
}
