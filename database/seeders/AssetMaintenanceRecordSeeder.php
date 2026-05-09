<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssetMaintenanceRecordSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'asset_id' => 1,
                'maintenance_date' => now()->subDays(5)->toDateString(),
                'vendor' => 'Demo vendor 1',
                'cost' => 1.00,
                'description' => 'Demo description 1',
                'status' => 'active',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'asset_id' => 1,
                'maintenance_date' => now()->subDays(10)->toDateString(),
                'vendor' => 'Demo vendor 2',
                'cost' => 1.00,
                'description' => 'Demo description 2',
                'status' => 'active',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'asset_id' => 1,
                'maintenance_date' => now()->subDays(15)->toDateString(),
                'vendor' => 'Demo vendor 3',
                'cost' => 1.00,
                'description' => 'Demo description 3',
                'status' => 'active',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('asset_maintenance_records')->updateOrInsert(
                ['asset_id' => $row['asset_id']],
                $row
            );
        }
    }
}
