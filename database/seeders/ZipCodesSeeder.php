<?php

namespace Database\Seeders;

use App\Models\ZipCode;
use Illuminate\Database\Seeder;

final class ZipCodesSeeder extends Seeder
{
    public function run()
    {
        $zipCodesData = [
            [
                'id' => 65001,
                'ZipCode' => '65001',
                'Country' => 'USA',
                'City' => 'Argyle',
                'County' => 'Osage',
                'State' => 'MO',
                'order' => 100,
                'StateLong' => 'Missouri',
                'Latitude' => 38.2993,
                'Longitude' => -92.0078,
                'RadLatitude' => 0.668449,
                'RadLongitude' => -1.60584,
                'AreaCode' => '573',
                'TimeZone' => -6,
                'timeORD' => '7 hours 18 mins',
                'distanceORD' => '433.0',
                'timeMDW' => '7 hours 4 mins',
                'distanceMDW' => '424.0',
                'timeCHI' => '7 hours 13 mins',
                'distanceCHI' => '432.0',
                'created' => null,
                'modified' => null,
            ],
            [
                'id' => 65010,
                'ZipCode' => '65010',
                'Country' => 'USA',
                'City' => 'Ashland',
                'County' => 'Boone',
                'State' => 'MO',
                'order' => 100,
                'StateLong' => 'Missouri',
                'Latitude' => 38.789,
                'Longitude' => -92.2597,
                'RadLatitude' => 0.676997,
                'RadLongitude' => -1.61023,
                'AreaCode' => '573',
                'TimeZone' => -6,
                'timeORD' => '6 hours 58 mins',
                'distanceORD' => '416.0',
                'timeMDW' => '6 hours 44 mins',
                'distanceMDW' => '407.0',
                'timeCHI' => '6 hours 53 mins',
                'distanceCHI' => '415.0',
                'created' => null,
                'modified' => null,
            ],
            [
                'id' => 65011,
                'ZipCode' => '65011',
                'Country' => 'USA',
                'City' => 'Barnett',
                'County' => 'Morgan',
                'State' => 'MO',
                'order' => 100,
                'StateLong' => 'Missouri',
                'Latitude' => 38.4004,
                'Longitude' => -92.7567,
                'RadLatitude' => 0.670213,
                'RadLongitude' => -1.61891,
                'AreaCode' => '573',
                'TimeZone' => -6,
                'timeORD' => '7 hours 38 mins',
                'distanceORD' => '435.0',
                'timeMDW' => '7 hours 25 mins',
                'distanceMDW' => '426.0',
                'timeCHI' => '7 hours 33 mins',
                'distanceCHI' => '434.0',
                'created' => null,
                'modified' => null,
            ],
            [
                'id' => 65013,
                'ZipCode' => '65013',
                'Country' => 'USA',
                'City' => 'Belle',
                'County' => 'Maries',
                'State' => 'MO',
                'order' => 100,
                'StateLong' => 'Missouri',
                'Latitude' => 38.2766,
                'Longitude' => -91.7263,
                'RadLatitude' => 0.668053,
                'RadLongitude' => -1.60093,
                'AreaCode' => '573',
                'TimeZone' => -6,
                'timeORD' => '6 hours 50 mins',
                'distanceORD' => '398.0',
                'timeMDW' => '6 hours 36 mins',
                'distanceMDW' => '389.0',
                'timeCHI' => '6 hours 45 mins',
                'distanceCHI' => '397.0',
                'created' => null,
                'modified' => null,
            ],
        ];

        foreach ($zipCodesData as $data) {
            ZipCode::createOrFirst(['id' => $data['id'], 'ZipCode' => $data['ZipCode']], $data);
        }
    }
}
