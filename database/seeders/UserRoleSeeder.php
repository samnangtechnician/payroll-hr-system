<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        $companyId = DB::table('companies')->where('company_code', 'DEMO')->value('id');

        $assignments = [
            'admin@payroll-hr.local' => 'Admin',
            'hr@payroll-hr.local' => 'HR Manager',
            'finance@payroll-hr.local' => 'Finance Manager',
        ];

        foreach ($assignments as $email => $roleName) {
            $userId = DB::table('users')->where('email', $email)->value('id');
            $roleId = DB::table('roles')->where('name', $roleName)->where('guard_name', 'web')->value('id');

            if ($userId === null || $roleId === null) {
                continue;
            }

            DB::table('user_roles')->updateOrInsert(
                ['user_id' => $userId, 'role_id' => $roleId, 'company_id' => $companyId],
                [
                    'user_id' => $userId,
                    'role_id' => $roleId,
                    'company_id' => $companyId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
