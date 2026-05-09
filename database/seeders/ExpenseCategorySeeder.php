<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpenseCategorySeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'company_id' => 1,
                'name' => 'Demo ExpenseCategories 1',
                'monthly_limit' => 1.00,
                'requires_receipt' => true,
                'is_active' => true,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'company_id' => 1,
                'name' => 'Demo ExpenseCategories 2',
                'monthly_limit' => 1.00,
                'requires_receipt' => true,
                'is_active' => true,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'company_id' => 1,
                'name' => 'Demo ExpenseCategories 3',
                'monthly_limit' => 1.00,
                'requires_receipt' => true,
                'is_active' => true,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('expense_categories')->updateOrInsert(
                ['company_id' => $row['company_id'], 'name' => $row['name']],
                $row
            );
        }
    }
}
