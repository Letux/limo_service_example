<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'user_id' => $this->faker->randomNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'return_from' => $this->faker->randomNumber(),
            'similar_order_id' => $this->faker->randomNumber(),
            'to' => $this->faker->randomNumber(),
            'status' => $this->faker->randomNumber(),
            'money_status' => $this->faker->randomNumber(),
            'rate_id' => $this->faker->randomNumber(),
            'pass_number' => $this->faker->randomNumber(),
            'pickup_time' => Carbon::now(),
            'pickup_zip' => $this->faker->postcode(),
            'pickup_address' => $this->faker->address(),
            'pickup_hotelbusiness' => $this->faker->word(),
            'pickup_street' => $this->faker->streetName(),
            'pickup_aptsuite' => $this->faker->word(),
            'airport_id' => $this->faker->randomNumber(),
            'airlines' => $this->faker->word(),
            'flight' => $this->faker->word(),
            'arrival' => $this->faker->word(),
            'flight_from' => $this->faker->word(),
            'luggage' => $this->faker->boolean(),
            'text_on_board' => $this->faker->text(),
            'charter_minutes' => $this->faker->randomNumber(),
            'dropoff_time' => Carbon::now(),
            'dropoff_zip' => $this->faker->postcode(),
            'dropoff_address' => $this->faker->address(),
            'dropoff_hotelbusiness' => $this->faker->word(),
            'dropoff_street' => $this->faker->streetName(),
            'dropoff_aptsuite' => $this->faker->word(),
            'primary_person_traveling' => $this->faker->word(),
            'phone' => $this->faker->phoneNumber(),
            'child_seat' => $this->faker->randomNumber(),
            'stops' => $this->faker->randomNumber(),
            'instructions' => $this->faker->word(),
            'car_id' => $this->faker->randomNumber(),
            'airport_tax' => $this->faker->randomFloat(),
            'step2_price' => $this->faker->randomFloat(),
            'way_price' => $this->faker->randomFloat(),
            'car_surcharge' => $this->faker->randomFloat(),
            'night_surcharge' => $this->faker->randomFloat(),
            'holiday_surcharge' => $this->faker->randomFloat(),
            'childseat_tax' => $this->faker->randomFloat(),
            'stops_tax' => $this->faker->randomFloat(),
            'luggage_tax' => $this->faker->randomFloat(),
            'step3_price' => $this->faker->randomFloat(),
            'promocode_tax' => $this->faker->randomFloat(),
            'promo_code_id' => $this->faker->randomNumber(),
            'tip' => $this->faker->randomFloat(),
            'tip_saved' => $this->faker->boolean(),
            'price' => $this->faker->randomFloat(),
            'card_number' => $this->faker->word(),
            'card_string' => $this->faker->word(),
            'expiration_date' => Carbon::now(),
            'name_on_card' => $this->faker->name(),
            'billing_street' => $this->faker->streetName(),
            'billing_aptsuite' => $this->faker->word(),
            'billing_country' => $this->faker->country(),
            'billing_city' => $this->faker->city(),
            'billing_state' => $this->faker->word(),
            'billing_zip' => $this->faker->postcode(),
            'admin_notes' => $this->faker->word(),
            'ip' => $this->faker->ipv4(),
            'ipstep4' => $this->faker->word(),
            'trace_path' => $this->faker->word(),
            'site' => $this->faker->word(),
            'created' => Carbon::now(),
            'modified' => Carbon::now(),
        ];
    }
}
