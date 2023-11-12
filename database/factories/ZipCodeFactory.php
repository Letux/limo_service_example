<?php

namespace Database\Factories;

use App\Models\ZipCode;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

final class ZipCodeFactory extends Factory
{
    protected $model = ZipCode::class;

    public function definition(): array
    {
        return [
            'ZipCode' => $this->faker->postcode(),
            'Country' => Str::random(3),
            'City' => $this->faker->city(),
            'County' => Str::random(3),
            'State' => Str::random(2),
            'order' => $this->faker->randomNumber(2),
            'StateLong' => $this->faker->word(),
            'Latitude' => $this->faker->latitude(),
            'Longitude' => $this->faker->longitude(),
            'RadLatitude' => $this->faker->latitude(),
            'RadLongitude' => $this->faker->longitude(),
            'AreaCode' => Str::random(3),
            'TimeZone' => $this->faker->randomNumber(),
            'timeORD' => $this->faker->word(),
            'distanceORD' => $this->faker->randomFloat(2, 0, 999),
            'timeMDW' => $this->faker->word(),
            'distanceMDW' => $this->faker->randomFloat(2, 0, 999),
            'timeCHI' => $this->faker->word(),
            'distanceCHI' => $this->faker->randomFloat(2, 0, 999),
            'created' => Carbon::now(),
            'modified' => Carbon::now(),
        ];
    }
}
