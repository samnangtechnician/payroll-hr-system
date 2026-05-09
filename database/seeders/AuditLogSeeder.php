<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuditLogSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'company_id' => 1,
                'user_id' => 1,
                'module' => 'demo_module_1',
                'action' => 'Demo action 1',
                'auditable_type' => 'general',
                'auditable_id' => 1,
                'old_values' => json_encode([]),
                'new_values' => json_encode([]),
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0 Demo',
                'action_at' => now()->subDays(1),
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'company_id' => 1,
                'user_id' => 1,
                'module' => 'demo_module_2',
                'action' => 'Demo action 2',
                'auditable_type' => 'general',
                'auditable_id' => 1,
                'old_values' => json_encode([]),
                'new_values' => json_encode([]),
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0 Demo',
                'action_at' => now()->subDays(2),
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'company_id' => 1,
                'user_id' => 1,
                'module' => 'demo_module_3',
                'action' => 'Demo action 3',
                'auditable_type' => 'general',
                'auditable_id' => 1,
                'old_values' => json_encode([]),
                'new_values' => json_encode([]),
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0 Demo',
                'action_at' => now()->subDays(3),
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($rows as $row) {
            DB::table('audit_logs')->updateOrInsert(
                ['company_id' => $row['company_id']],
                $row
            );
        }
    }
}
