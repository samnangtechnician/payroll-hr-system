<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LearningCertificateSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'learning_assignment_id' => 1,
                'certificate_no' => 'CERTIFICATE-0001',
                'issued_date' => now()->subDays(5)->toDateString(),
                'file_path' => 'storage/demo/learning_certificates/file_path_1.txt',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'learning_assignment_id' => 1,
                'certificate_no' => 'CERTIFICATE-0002',
                'issued_date' => now()->subDays(10)->toDateString(),
                'file_path' => 'storage/demo/learning_certificates/file_path_2.txt',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'learning_assignment_id' => 1,
                'certificate_no' => 'CERTIFICATE-0003',
                'issued_date' => now()->subDays(15)->toDateString(),
                'file_path' => 'storage/demo/learning_certificates/file_path_3.txt',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('learning_certificates')->updateOrInsert(
                ['certificate_no' => $row['certificate_no']],
                $row
            );
        }
    }
}
