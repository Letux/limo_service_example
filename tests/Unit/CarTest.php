<?php

namespace Tests\Unit;

use App\Models\Car;
use Tests\TestCase;

final class CarTest extends TestCase
{
    public function testGetMaxPassengers()
    {
        Car::factory()->create(['pass_number' => 1, 'visibility' => 'yes']);
        Car::factory()->create(['pass_number' => 4, 'visibility' => 'yes']);
        Car::factory()->create(['pass_number' => 10, 'visibility' => 'no']);
        Car::factory()->create(['pass_number' => 3, 'visibility' => 'yes']);

        $this->assertEquals(4, Car::getMaxPassengers());
    }
}
