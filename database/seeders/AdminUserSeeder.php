<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $company = Company::query()->first();
        $adminRole = Role::query()->where('name', 'Admin')->first();

        $admin = User::query()->updateOrCreate(
            ['email' => 'admin@payroll-hr.local'],
            [
                'company_id' => $company?->id,
                'name' => 'System Administrator',
                'username' => 'admin',
                'password' => Hash::make('password'),
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );

        if ($adminRole) {
            UserRole::query()->updateOrCreate(
                [
                    'user_id' => $admin->id,
                    'role_id' => $adminRole->id,
                    'company_id' => $company?->id,
                    'country_id' => null,
                    'branch_id' => null,
                    'department_id' => null,
                ],
                []
            );
        }
    }
}
