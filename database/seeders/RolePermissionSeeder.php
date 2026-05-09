<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $roles = DB::table('roles')->where('guard_name', 'web')->get(['id', 'name']);
        $perms = DB::table('permissions')->where('guard_name', 'web')->get(['id', 'module', 'name']);

        foreach ($roles as $role) {
            $allowed = match ($role->name) {
                'Admin' => $perms->all(),
                'HR Manager' => $perms->whereIn('module', [
                    'employees', 'users', 'leave_types', 'leave_requests',
                    'public_holidays', 'attendance', 'reports',
                ])->all(),
                'Finance Manager' => $perms->whereIn('module', [
                    'payroll_periods', 'payroll_runs', 'payslips',
                    'salary_components', 'expenses', 'reports',
                ])->all(),
                'Branch Manager' => $perms->whereIn('module', [
                    'departments', 'positions', 'employees',
                    'leave_requests', 'attendance', 'reports',
                ])->all(),
                default => $perms->where('name', 'leave_requests.view')->all(),
            };

            foreach ($allowed as $perm) {
                DB::table('role_permission')->updateOrInsert(
                    ['role_id' => $role->id, 'permission_id' => $perm->id],
                    [
                        'role_id' => $role->id,
                        'permission_id' => $perm->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
        }
    }
}
