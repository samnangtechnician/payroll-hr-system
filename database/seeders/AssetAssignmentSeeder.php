<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssetAssignmentSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'asset_id' => 1,
                'employee_id' => 1,
                'assigned_date' => now()->subDays(5)->toDateString(),
                'returned_date' => now()->subDays(5)->toDateString(),
                'condition_on_assign' => 'Demo condition_on_assign 1',
                'condition_on_return' => 'Demo condition_on_return 1',
                'remarks' => 'Demo remarks 1',
                'assigned_by' => 1,
                'received_by' => 1,
                'status' => 'active',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
                'deleted_at' => null,
            ],
            [
                'asset_id' => 1,
                'employee_id' => 1,
                'assigned_date' => now()->subDays(10)->toDateString(),
                'returned_date' => now()->subDays(10)->toDateString(),
                'condition_on_assign' => 'Demo condition_on_assign 2',
                'condition_on_return' => 'Demo condition_on_return 2',
                'remarks' => 'Demo remarks 2',
                'assigned_by' => 1,
                'received_by' => 1,
                'status' => 'active',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
                'deleted_at' => null,
            ],
            [
                'asset_id' => 1,
                'employee_id' => 1,
                'assigned_date' => now()->subDays(15)->toDateString(),
                'returned_date' => now()->subDays(15)->toDateString(),
                'condition_on_assign' => 'Demo condition_on_assign 3',
                'condition_on_return' => 'Demo condition_on_return 3',
                'remarks' => 'Demo remarks 3',
                'assigned_by' => 1,
                'received_by' => 1,
                'status' => 'active',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
                'deleted_at' => null,
            ],
        ];

        foreach ($rows as $row) {
            DB::table('asset_assignments')->updateOrInsert(
                ['asset_id' => $row['asset_id']],
                $row
            );
        }
    }
}
