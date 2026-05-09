<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CandidateDocumentSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'candidate_id' => 1,
                'document_type' => 'general',
                'file_path' => 'storage/demo/candidate_documents/file_path_1.txt',
                'file_name' => 'Demo file_name 1',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'candidate_id' => 1,
                'document_type' => 'general',
                'file_path' => 'storage/demo/candidate_documents/file_path_2.txt',
                'file_name' => 'Demo file_name 2',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'candidate_id' => 1,
                'document_type' => 'general',
                'file_path' => 'storage/demo/candidate_documents/file_path_3.txt',
                'file_name' => 'Demo file_name 3',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('candidate_documents')->updateOrInsert(
                ['candidate_id' => $row['candidate_id']],
                $row
            );
        }
    }
}
