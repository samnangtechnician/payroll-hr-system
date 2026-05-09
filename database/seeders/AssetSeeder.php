<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssetSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'company_id' => 1,
                'asset_category_id' => 1,
                'branch_id' => 1,
                'asset_code' => 'ASSET-0001',
                'name' => 'Demo Assets 1',
                'brand_model' => 'Demo brand_model 1',
                'serial_no' => 'SERIAL-0001',
                'purchase_date' => now()->subDays(5)->toDateString(),
                'purchase_cost' => 1.00,
                'currency_id' => 1,
                'location' => 'Demo location 1',
                'condition' => 'Demo condition 1',
                'status' => 'active',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
                'deleted_at' => null,
            ],
            [
                'company_id' => 1,
                'asset_category_id' => 1,
                'branch_id' => 1,
                'asset_code' => 'ASSET-0002',
                'name' => 'Demo Assets 2',
                'brand_model' => 'Demo brand_model 2',
                'serial_no' => 'SERIAL-0002',
                'purchase_date' => now()->subDays(10)->toDateString(),
                'purchase_cost' => 1.00,
                'currency_id' => 1,
                'location' => 'Demo location 2',
                'condition' => 'Demo condition 2',
                'status' => 'active',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
                'deleted_at' => null,
            ],
            [
                'company_id' => 1,
                'asset_category_id' => 1,
                'branch_id' => 1,
                'asset_code' => 'ASSET-0003',
                'name' => 'Demo Assets 3',
                'brand_model' => 'Demo brand_model 3',
                'serial_no' => 'SERIAL-0003',
                'purchase_date' => now()->subDays(15)->toDateString(),
                'purchase_cost' => 1.00,
                'currency_id' => 1,
                'location' => 'Demo location 3',
                'condition' => 'Demo condition 3',
                'status' => 'active',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
                'deleted_at' => null,
            ],
        ];

        foreach ($rows as $row) {
            DB::table('assets')->updateOrInsert(
                ['asset_code' => $row['asset_code']],
                $row
            );
        }
    }
}
