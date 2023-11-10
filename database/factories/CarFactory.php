<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

final class CarFactory extends Factory
{
    protected $model = Car::class;

    public function definition(): array
    {
        return [
            'path' => $this->faker->word(),
            'descr' => $this->faker->word(),
            'short_name' => $this->faker->name(),
            'path_int' => $this->faker->word(),
            'path_ext' => $this->faker->word(),
            'interior' => $this->faker->word(),
            'exterior' => $this->faker->word(),
            'pass_number' => $this->faker->numberBetween(1,22),
            'bags_number' => $this->faker->randomNumber(2),
            'night_mult' => $this->faker->randomFloat(1, 1.0, 2.0),
            'multiplier' => $this->faker->randomFloat(1, 1.0, 4.0),
            'sort_order' => $this->faker->randomNumber(2),
            'not_work_days' => '',
            'holiday_multiplier' => $this->faker->randomFloat(1, 1.0, 2.0),
            'p2p_multiplier' => $this->faker->randomFloat(1, 1.0, 4.0),
            'p2p_holiday_multiplier' => $this->faker->randomFloat(1, 1.0, 2.0),
            'hc_holiday_multiplier' => $this->faker->randomFloat(1, 1.0, 2.0),
            'pre_time_additional' => $this->faker->randomNumber(),
            'visibility' => $this->faker->randomElement(['yes', 'no']),
            'created' => Carbon::now(),
            'modified' => Carbon::now(),
        ];
    }
}
