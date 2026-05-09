<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BackupLogSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'company_id' => 1,
                'created_by' => 1,
                'backup_type' => 'general',
                'storage_disk' => 'Demo storage_disk 1',
                'file_path' => 'storage/demo/backup_logs/file_path_1.txt',
                'file_size' => 1,
                'started_at' => now()->subDays(1),
                'completed_at' => now()->subDays(1),
                'status' => 'active',
                'error_message' => 'Demo error_message 1',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'company_id' => 1,
                'created_by' => 1,
                'backup_type' => 'general',
                'storage_disk' => 'Demo storage_disk 2',
                'file_path' => 'storage/demo/backup_logs/file_path_2.txt',
                'file_size' => 2,
                'started_at' => now()->subDays(2),
                'completed_at' => now()->subDays(2),
                'status' => 'active',
                'error_message' => 'Demo error_message 2',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'company_id' => 1,
                'created_by' => 1,
                'backup_type' => 'general',
                'storage_disk' => 'Demo storage_disk 3',
                'file_path' => 'storage/demo/backup_logs/file_path_3.txt',
                'file_size' => 3,
                'started_at' => now()->subDays(3),
                'completed_at' => now()->subDays(3),
                'status' => 'active',
                'error_message' => 'Demo error_message 3',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('backup_logs')->updateOrInsert(
                ['company_id' => $row['company_id']],
                $row
            );
        }
    }
}
