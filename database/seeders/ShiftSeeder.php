<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShiftSeeder extends Seeder
{
    public function run(): void
    {
        $companyId = DB::table('companies')->where('company_code', 'DEMO')->value('id');

        $rows = [
            ['shift_code' => 'STD',   'name' => 'Standard 9-to-5', 'start_time' => '09:00:00', 'end_time' => '17:00:00', 'break_minutes' => 60, 'late_grace_minutes' => 10, 'early_leave_grace_minutes' => 10, 'is_night_shift' => false],
            ['shift_code' => 'EARLY', 'name' => 'Early Shift',     'start_time' => '06:00:00', 'end_time' => '14:00:00', 'break_minutes' => 60, 'late_grace_minutes' => 5,  'early_leave_grace_minutes' => 5,  'is_night_shift' => false],
            ['shift_code' => 'NIGHT', 'name' => 'Night Shift',     'start_time' => '22:00:00', 'end_time' => '06:00:00', 'break_minutes' => 60, 'late_grace_minutes' => 10, 'early_leave_grace_minutes' => 10, 'is_night_shift' => true],
        ];

        foreach ($rows as $row) {
            DB::table('shifts')->updateOrInsert(
                ['company_id' => $companyId, 'shift_code' => $row['shift_code']],
                array_merge($row, [
                    'company_id' => $companyId,
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }
}
