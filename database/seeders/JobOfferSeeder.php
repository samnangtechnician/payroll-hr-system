<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobOfferSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'candidate_id' => 1,
                'job_vacancy_id' => 1,
                'offer_no' => 'OFFER-0001',
                'offered_salary' => 600.00,
                'currency_id' => 1,
                'offer_date' => now()->subDays(5)->toDateString(),
                'expected_join_date' => now()->subDays(5)->toDateString(),
                'offer_letter_path' => 'storage/demo/job_offers/offer_letter_path_1.txt',
                'status' => 'active',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
                'deleted_at' => null,
            ],
            [
                'candidate_id' => 1,
                'job_vacancy_id' => 1,
                'offer_no' => 'OFFER-0002',
                'offered_salary' => 700.00,
                'currency_id' => 1,
                'offer_date' => now()->subDays(10)->toDateString(),
                'expected_join_date' => now()->subDays(10)->toDateString(),
                'offer_letter_path' => 'storage/demo/job_offers/offer_letter_path_2.txt',
                'status' => 'active',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
                'deleted_at' => null,
            ],
            [
                'candidate_id' => 1,
                'job_vacancy_id' => 1,
                'offer_no' => 'OFFER-0003',
                'offered_salary' => 800.00,
                'currency_id' => 1,
                'offer_date' => now()->subDays(15)->toDateString(),
                'expected_join_date' => now()->subDays(15)->toDateString(),
                'offer_letter_path' => 'storage/demo/job_offers/offer_letter_path_3.txt',
                'status' => 'active',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
                'deleted_at' => null,
            ],
        ];

        foreach ($rows as $row) {
            DB::table('job_offers')->updateOrInsert(
                ['offer_no' => $row['offer_no']],
                $row
            );
        }
    }
}
