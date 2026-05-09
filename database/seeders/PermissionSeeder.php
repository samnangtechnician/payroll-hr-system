<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $modules = [
            'companies', 'branches', 'departments', 'positions',
            'employees', 'users', 'roles',
            'leave_types', 'leave_requests',
            'shifts', 'attendance', 'public_holidays',
            'payroll_periods', 'payroll_runs', 'payslips',
            'salary_components', 'projects',
            'assets', 'expenses', 'reports', 'settings',
        ];
        $actions = ['view', 'create', 'update', 'delete'];

        foreach ($modules as $module) {
            foreach ($actions as $action) {
                $name = $module.'.'.$action;
                DB::table('permissions')->updateOrInsert(
                    ['module' => $module, 'name' => $name, 'guard_name' => 'web'],
                    [
                        'module' => $module,
                        'name' => $name,
                        'guard_name' => 'web',
                        'description' => ucfirst($action).' '.str_replace('_', ' ', $module),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
        }
    }
}
