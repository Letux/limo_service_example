<?php

namespace Database\Factories;

use App\Models\Rate;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

final class RateFactory extends Factory
{
    protected $model = Rate::class;

    public function definition(): array
    {
        return [
            'zip' => $this->faker->postcode(),
            'town' => $this->faker->word(),
            'state' => $this->faker->word(),
            'short_name' => $this->faker->name(),
            'ORD' => $this->faker->randomNumber(),
            'MDW' => $this->faker->randomNumber(),
            'MKE' => $this->faker->randomNumber(),
            'CHI' => $this->faker->randomNumber(),
            'chicagoland' => $this->faker->boolean(),
            'major_city' => $this->faker->city(),
            'url_rates' => $this->faker->url(),
            'manual_rate' => $this->faker->boolean(),
            'old_id' => $this->faker->randomNumber(),
            'created' => Carbon::now(),
            'modified' => Carbon::now(),
        ];
    }
}
