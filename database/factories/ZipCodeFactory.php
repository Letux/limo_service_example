<?php

namespace Database\Factories;

use App\Models\ZipCode;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

final class ZipCodeFactory extends Factory
{
    protected $model = ZipCode::class;

    public function definition(): array
    {
        return [
            'ZipCode' => $this->faker->postcode(),
            'Country' => $this->faker->country(),
            'City' => $this->faker->city(),
            'County' => $this->faker->word(),
            'State' => $this->faker->word(),
            'order' => $this->faker->randomNumber(),
            'StateLong' => $this->faker->word(),
            'Latitude' => $this->faker->latitude(),
            'Longitude' => $this->faker->longitude(),
            'RadLatitude' => $this->faker->latitude(),
            'RadLongitude' => $this->faker->longitude(),
            'AreaCode' => $this->faker->word(),
            'TimeZone' => $this->faker->randomNumber(),
            'timeORD' => $this->faker->word(),
            'distanceORD' => $this->faker->randomFloat(),
            'timeMDW' => $this->faker->word(),
            'distanceMDW' => $this->faker->randomFloat(),
            'timeCHI' => $this->faker->word(),
            'distanceCHI' => $this->faker->randomFloat(),
            'created' => Carbon::now(),
            'modified' => Carbon::now(),
        ];
    }
}
