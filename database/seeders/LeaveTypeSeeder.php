<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeaveTypeSeeder extends Seeder
{
    public function run(): void
    {
        $companyId = DB::table('companies')->where('company_code', 'DEMO')->value('id');
        $countryId = DB::table('countries')->where('iso2', 'KH')->value('id');

        $rows = [
            ['code' => 'AL',  'name' => 'Annual Leave',    'default_entitlement_days' => 18.00, 'is_paid' => true,  'allow_half_day' => true,  'requires_attachment' => false],
            ['code' => 'SL',  'name' => 'Sick Leave',      'default_entitlement_days' => 7.00,  'is_paid' => true,  'allow_half_day' => true,  'requires_attachment' => true],
            ['code' => 'ML',  'name' => 'Maternity Leave', 'default_entitlement_days' => 90.00, 'is_paid' => true,  'allow_half_day' => false, 'requires_attachment' => true],
            ['code' => 'UPL', 'name' => 'Unpaid Leave',    'default_entitlement_days' => 0.00,  'is_paid' => false, 'allow_half_day' => true,  'requires_attachment' => false],
            ['code' => 'SPL', 'name' => 'Special Leave',   'default_entitlement_days' => 5.00,  'is_paid' => true,  'allow_half_day' => false, 'requires_attachment' => true],
        ];

        foreach ($rows as $row) {
            DB::table('leave_types')->updateOrInsert(
                ['company_id' => $companyId, 'code' => $row['code']],
                array_merge($row, [
                    'company_id' => $companyId,
                    'country_id' => $countryId,
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }
}
