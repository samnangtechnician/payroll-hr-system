<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeavePolicySeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'company_id' => 1,
                'country_id' => 1,
                'leave_type_id' => 1,
                'entitlement_days' => 1.00,
                'allow_carry_forward' => true,
                'max_carry_forward_days' => 1.00,
                'deduct_from_payroll' => true,
                'rules' => json_encode([]),
                'is_active' => true,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'company_id' => 1,
                'country_id' => 1,
                'leave_type_id' => 1,
                'entitlement_days' => 1.00,
                'allow_carry_forward' => true,
                'max_carry_forward_days' => 1.00,
                'deduct_from_payroll' => true,
                'rules' => json_encode([]),
                'is_active' => true,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'company_id' => 1,
                'country_id' => 1,
                'leave_type_id' => 1,
                'entitlement_days' => 1.00,
                'allow_carry_forward' => true,
                'max_carry_forward_days' => 1.00,
                'deduct_from_payroll' => true,
                'rules' => json_encode([]),
                'is_active' => true,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('leave_policies')->updateOrInsert(
                ['company_id' => $row['company_id']],
                $row
            );
        }
    }
}
