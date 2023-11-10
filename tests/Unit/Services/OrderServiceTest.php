<?php

namespace Tests\Unit\Services;

use App\Services\OrderService;
use Database\Seeders\SettingsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

final class OrderServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $service;

    public function __construct(string $name)
    {
        parent::__construct($name);

        $this->service = new OrderService();
    }

    public function testGetStep1TimeSettings()
    {
        $this->seed(SettingsSeeder::class);

        Carbon::setTestNow(Carbon::create(2023, 1, 1, 1));
        $this->assertEquals([0, 9], $this->service->getStep1TimeSettings());

        Carbon::setTestNow(Carbon::create(2023, 1, 1, 22));
        $this->assertEquals([1, 9], $this->service->getStep1TimeSettings());

        Carbon::setTestNow(Carbon::create(2023, 1, 1, 8));
        $this->assertEquals([0, 11], $this->service->getStep1TimeSettings());
    }

    public function testStep1InitVars()
    {
        self::markTestIncomplete();
    }

    public function testAtNight()
    {
        Carbon::setTestNow(Carbon::create(2023, 1, 1, 18));
        $this->assertFalse($this->atNight());

        Carbon::setTestNow(Carbon::create(2023, 1, 1, 19));
        $this->assertTrue($this->atNight());

        Carbon::setTestNow(Carbon::create(2023, 1, 1, 22));
        $this->assertTrue($this->atNight());

        Carbon::setTestNow(Carbon::create(2023, 1, 1, 0));
        $this->assertTrue($this->atNight());

        Carbon::setTestNow(Carbon::create(2023, 1, 1, 5));
        $this->assertTrue($this->atNight());

        Carbon::setTestNow(Carbon::create(2023, 1, 1, 6));
        $this->assertFalse($this->atNight());
    }

    protected function atNight(): bool
    {
        return $this->service->atNight(22, 6, 3);
    }
}
