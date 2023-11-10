<?php

namespace Database\Seeders;

use App\Models\Airport;
use Illuminate\Database\Seeder;

final class AirportsSeeder extends Seeder
{
    public function run(): void
    {
        Airport::createOrFirst(
            [
                'id' => 1,
            ],
            [
                'name' => 'O\'Hare',
                'short_name' => 'ORD',
                'zip' => 60666,
                'pickup_tax' => 4.00,
                'dropoff_tax' => 4.00,
            ]
        );

        Airport::createOrFirst(
            [
                'id' => 2,
            ],
            [
                'name' => 'Midway',
                'short_name' => 'MDW',
                'zip' => 60638,
                'pickup_tax' => 4.00,
                'dropoff_tax' => 4.00,
            ]
        );
    }
}
