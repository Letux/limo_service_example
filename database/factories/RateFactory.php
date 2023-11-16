<?php

namespace Database\Factories;

use App\Models\Rate;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

final class RateFactory extends Factory
{
    protected $model = Rate::class;

    public function definition(): array
    {

        return [
            'zip' => $this->faker->randomNumber(5),
            'town' => $this->faker->city(),
            'state' => Str::random(2),
            'short_name' => $this->faker->name(),
            'ORD' => $this->faker->randomNumber(),
            'MDW' => $this->faker->randomNumber(),
            'MKE' => $this->faker->randomNumber(),
            'CHI' => $this->faker->randomNumber(),
            'chicagoland' => $this->faker->boolean(),
            'major_city' => $this->faker->boolean(),
            'url_rates' => $this->faker->url(),
            'manual_rate' => $this->faker->boolean(),
            'old_id' => $this->faker->randomNumber(),
            'created' => Carbon::now(),
            'modified' => Carbon::now(),
        ];
    }
}
