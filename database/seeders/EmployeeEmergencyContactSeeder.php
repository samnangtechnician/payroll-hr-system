<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeEmergencyContactSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'employee_id' => 1,
                'name' => 'Demo EmployeeEmergencyContacts 1',
                'relationship' => 'Demo relationship 1',
                'phone' => '+85512000001',
                'email' => 'employee_emergency_contacts_1@payroll-hr.local',
                'address' => 'Demo address 1',
                'is_primary' => true,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'employee_id' => 1,
                'name' => 'Demo EmployeeEmergencyContacts 2',
                'relationship' => 'Demo relationship 2',
                'phone' => '+85512000002',
                'email' => 'employee_emergency_contacts_2@payroll-hr.local',
                'address' => 'Demo address 2',
                'is_primary' => true,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'employee_id' => 1,
                'name' => 'Demo EmployeeEmergencyContacts 3',
                'relationship' => 'Demo relationship 3',
                'phone' => '+85512000003',
                'email' => 'employee_emergency_contacts_3@payroll-hr.local',
                'address' => 'Demo address 3',
                'is_primary' => true,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('employee_emergency_contacts')->updateOrInsert(
                ['name' => $row['name']],
                $row
            );
        }
    }
}
