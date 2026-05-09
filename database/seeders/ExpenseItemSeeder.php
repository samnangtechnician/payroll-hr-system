<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpenseItemSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'expense_claim_id' => 1,
                'expense_category_id' => 1,
                'expense_date' => now()->subDays(5)->toDateString(),
                'amount' => 600.00,
                'receipt_path' => 'storage/demo/expense_items/receipt_path_1.txt',
                'description' => 'Demo description 1',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'expense_claim_id' => 1,
                'expense_category_id' => 1,
                'expense_date' => now()->subDays(10)->toDateString(),
                'amount' => 700.00,
                'receipt_path' => 'storage/demo/expense_items/receipt_path_2.txt',
                'description' => 'Demo description 2',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'expense_claim_id' => 1,
                'expense_category_id' => 1,
                'expense_date' => now()->subDays(15)->toDateString(),
                'amount' => 800.00,
                'receipt_path' => 'storage/demo/expense_items/receipt_path_3.txt',
                'description' => 'Demo description 3',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('expense_items')->updateOrInsert(
                ['expense_claim_id' => $row['expense_claim_id']],
                $row
            );
        }
    }
}
