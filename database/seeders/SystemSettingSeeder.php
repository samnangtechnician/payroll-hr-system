<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SystemSettingSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'company_id' => 1,
                'group' => 'Demo group 1',
                'key' => 'demo_key_1',
                'value' => 'Demo value 1',
                'value_type' => 'general',
                'is_encrypted' => true,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'company_id' => 1,
                'group' => 'Demo group 2',
                'key' => 'demo_key_2',
                'value' => 'Demo value 2',
                'value_type' => 'general',
                'is_encrypted' => true,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'company_id' => 1,
                'group' => 'Demo group 3',
                'key' => 'demo_key_3',
                'value' => 'Demo value 3',
                'value_type' => 'general',
                'is_encrypted' => true,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('system_settings')->updateOrInsert(
                ['company_id' => $row['company_id'], 'key' => $row['key']],
                $row
            );
        }
    }
}
