<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeDocumentSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'employee_id' => 1,
                'document_type_id' => 1,
                'document_no' => 'DOCUMENT-0001',
                'title' => 'Demo EmployeeDocuments 1',
                'file_path' => 'storage/demo/employee_documents/file_path_1.txt',
                'file_name' => 'Demo file_name 1',
                'mime_type' => 'general',
                'file_size' => 1,
                'issued_date' => now()->subDays(5)->toDateString(),
                'expiry_date' => now()->subDays(5)->toDateString(),
                'uploaded_by' => 1,
                'status' => 'active',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
                'deleted_at' => null,
            ],
            [
                'employee_id' => 1,
                'document_type_id' => 1,
                'document_no' => 'DOCUMENT-0002',
                'title' => 'Demo EmployeeDocuments 2',
                'file_path' => 'storage/demo/employee_documents/file_path_2.txt',
                'file_name' => 'Demo file_name 2',
                'mime_type' => 'general',
                'file_size' => 2,
                'issued_date' => now()->subDays(10)->toDateString(),
                'expiry_date' => now()->subDays(10)->toDateString(),
                'uploaded_by' => 1,
                'status' => 'active',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
                'deleted_at' => null,
            ],
            [
                'employee_id' => 1,
                'document_type_id' => 1,
                'document_no' => 'DOCUMENT-0003',
                'title' => 'Demo EmployeeDocuments 3',
                'file_path' => 'storage/demo/employee_documents/file_path_3.txt',
                'file_name' => 'Demo file_name 3',
                'mime_type' => 'general',
                'file_size' => 3,
                'issued_date' => now()->subDays(15)->toDateString(),
                'expiry_date' => now()->subDays(15)->toDateString(),
                'uploaded_by' => 1,
                'status' => 'active',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
                'deleted_at' => null,
            ],
        ];

        foreach ($rows as $row) {
            DB::table('employee_documents')->updateOrInsert(
                ['employee_id' => $row['employee_id']],
                $row
            );
        }
    }
}
