<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

final class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        Setting::createOrFirst(
            [
                'property_name' => 'pre_hours',
            ],
            [
                'value' => '3',
                'coments' => '',
                'order' => 0,
            ]
        );
        Setting::createOrFirst(
            [
                'property_name' => 'pre_hours_night_start',
            ],
            [
                'value' => '22',
                'coments' => '',
                'order' => 0,
            ]
        );
        Setting::createOrFirst(
            [
                'property_name' => 'pre_hours_night_end',
            ],
            [
                'value' => '6',
                'coments' => '',
                'order' => 0,
            ]
        );



        Setting::createOrFirst(
            [
                'property_name' => 'time_ohara_to_midway',
            ],
            [
                'value' => '1',
                'coments' => '',
                'order' => 0,
            ]
        );
    }
}
