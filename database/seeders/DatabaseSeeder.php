<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CountrySeeder::class,
            CurrencySeeder::class,
            RolePermissionSeeder::class,
            CompanyAndBranchSeeder::class,
            AdminUserSeeder::class,
        ]);
    }
}
