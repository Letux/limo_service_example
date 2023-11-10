<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

final class CarsSeeder extends Seeder
{
    public function run()
    {
        Car::createOrFirst(
            [
                'descr' => '3 passenger Cadillac XTS Luxury Sedan',
            ],
            [
                'path' => 'images/2013-cadillac-xts-154.png',
                'short_name' => '3paxXTS',
                'path_int' => 'images/2013-cadillac-xts-interior.gif',
                'path_ext' => 'images/2013-cadillac-xts.png',
                'interior' => '',
                'exterior' => '',
                'pass_number' => 3,
                'bags_number' => 2,
                'night_mult' => 1.2,
                'multiplier' => 1,
                'sort_order' => 14,
                'not_work_days' => '0',
                'holiday_multiplier' => 1.5,
                'p2p_multiplier' => 1,
                'p2p_holiday_multiplier' => 1.5,
                'hc_holiday_multiplier' => 1.5,
                'pre_time_additional' => 0,
                'visibility' => 'yes',
            ]
        );

        Car::createOrFirst(
            [
                'descr' => '10 Passenger Lincoln Stretch',
            ],
            [
                'path' => 'images/stretch-towncar-10passenger-150px.gif',
                'short_name' => '10paxStretch',
                'path_int' => 'images/2006_lincoln_stretch_limousine_10_passenger-interior.jpg',
                'path_ext' => 'images/stretch-towncar-10passenger-192px.jpg',
                'interior' => '',
                'exterior' => '',
                'pass_number' => 10,
                'bags_number' => 0,
                'night_mult' => 1.1,
                'multiplier' => 1.8,
                'sort_order' => 37,
                'not_work_days' => '0',
                'holiday_multiplier' => 1.5,
                'p2p_multiplier' => 1.8,
                'p2p_holiday_multiplier' => 1.5,
                'hc_holiday_multiplier' => 1.5,
                'pre_time_additional' => 0,
                'visibility' => 'yes',
            ]
        );

        Car::createOrFirst(
            [
                'descr' => '3 passenger Mercedes Benz s 550 Sedan',
            ],
            [
            'path' => 'images/mercedes-s500-limo.jpg',
            'short_name' => '3paxMerc500',
            'path_int' => 'images/mercedes-s500-limo-internal.jpg',
            'path_ext' => 'images/mercedes-s500-limo-outer.jpg',
            'interior' => 'Seats up to 3 passengers; Leather interior; Tinted windows for privacy',
            'exterior' => 'Always clean and elegant',
            'pass_number' => 3,
            'bags_number' => 0,
            'night_mult' => 1.1,
            'multiplier' => 1.4,
            'sort_order' => 24,
            'not_work_days' => '0',
            'holiday_multiplier' => 1.4,
            'p2p_multiplier' => 1.4,
            'p2p_holiday_multiplier' => 1.4,
            'hc_holiday_multiplier' => 1.4,
            'pre_time_additional' => 0,
            'visibility' => 'yes',
        ]);
    }
}
