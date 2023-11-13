<?php

namespace Database\Seeders;

use App\Models\Rate;
use Illuminate\Database\Seeder;

final class RatesSeeder extends Seeder
{
    public function run(): void
    {
        Rate::createOrFirst(
            [
                'zip' => '65001',
            ],
            [
                'town' => 'Argyle',
                'state' => 'MO',
                'short_name' => '',
                'ORD' => 650,
                'MDW' => 636,
                'MKE' => 0,
                'CHI' => 648,
                'chicagoland' => 0,
                'major_city' => 0,
                'url_rates' => null,
                'manual_rate' => 0,
                'old_id' => 0,
            ]
        );

        Rate::createOrFirst(
            [
                'zip' => '65010',
            ],
            [
                'town' => 'Ashland',
                'state' => 'MO',
                'short_name' => '',
                'ORD' => 624,
                'MDW' => 611,
                'MKE' => 0,
                'CHI' => 623,
                'chicagoland' => 0,
                'major_city' => 0,
                'url_rates' => null,
                'manual_rate' => 0,
                'old_id' => 0,
            ]
        );

        Rate::createOrFirst(
            [
                'zip' => '65011',
            ],
            [
                'town' => 'Barnett',
                'state' => 'MO',
                'short_name' => '',
                'ORD' => 653,
                'MDW' => 639,
                'MKE' => 0,
                'CHI' => 651,
                'chicagoland' => 0,
                'major_city' => 0,
                'url_rates' => null,
                'manual_rate' => 0,
                'old_id' => 0,
            ]
        );

        Rate::createOrFirst(
            [
                'zip' => '65013',
            ],
            [
                'town' => 'Belle',
                'state' => 'MO',
                'short_name' => '',
                'ORD' => 597,
                'MDW' => 584,
                'MKE' => 0,
                'CHI' => 596,
                'chicagoland' => 0,
                'major_city' => 0,
                'url_rates' => null,
                'manual_rate' => 0,
                'old_id' => 0,
            ]
        );
    }
}
