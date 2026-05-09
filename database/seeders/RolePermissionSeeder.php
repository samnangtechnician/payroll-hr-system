<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'Admin',           'guard_name' => 'web', 'description' => 'Full administrative access', 'is_system' => true],
            ['name' => 'HR Manager',      'guard_name' => 'web', 'description' => 'Manages HR operations',       'is_system' => true],
            ['name' => 'Finance Manager', 'guard_name' => 'web', 'description' => 'Manages payroll and finance', 'is_system' => true],
            ['name' => 'Branch Manager',  'guard_name' => 'web', 'description' => 'Manages a single branch',     'is_system' => true],
            ['name' => 'Employee',        'guard_name' => 'web', 'description' => 'Standard employee access',    'is_system' => true],
        ];

        foreach ($roles as $row) {
            Role::query()->updateOrCreate(
                ['company_id' => null, 'name' => $row['name'], 'guard_name' => $row['guard_name']],
                array_merge(['is_active' => true], $row)
            );
        }
    }
}
