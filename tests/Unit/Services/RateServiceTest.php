<?php

namespace Tests\Unit\Services;

use App\Models\Rate;
use App\Services\RateService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class RateServiceTest extends TestCase
{
    use RefreshDatabase;

    private function addRateFactories(): void
    {
        Rate::factory()->create([
            'town' => 'New York',
            'state' => 'NY',
            'zip' => '10001',
        ]);
        Rate::factory()->create([
            'town' => 'New Yorker',
            'state' => 'NY',
            'zip' => '10002',
        ]);
        Rate::factory()->create([
            'town' => 'Chicago',
            'state' => 'IL',
            'zip' => '60007',
        ]);
    }

    public function testGetAutocompleteResult()
    {
        $this->addRateFactories();

        $result = RateService::getAutocompleteResult(Rate::all());

        $this->assertCount(3, $result);
        $this->assertEquals('New York, NY 10001', $result[0]['label']);
        $this->assertEquals('New York, NY 10001', $result[0]['value']);
        $this->assertEquals('New Yorker, NY 10002', $result[1]['label']);
        $this->assertEquals('New Yorker, NY 10002', $result[1]['value']);
        $this->assertEquals('Chicago, IL 60007', $result[2]['label']);
        $this->assertEquals('Chicago, IL 60007', $result[2]['value']);
    }

    public function testGetAutocompleteCitiesByZip()
    {
        $this->addRateFactories();

        $result = RateService::getAutocompleteCitiesByZip('1000', 10);

        $this->assertCount(2, $result);
        $this->assertEquals('New York, NY 10001', $result[0]['label']);
        $this->assertEquals('New York, NY 10001', $result[0]['value']);
        $this->assertEquals('New Yorker, NY 10002', $result[1]['label']);
        $this->assertEquals('New Yorker, NY 10002', $result[1]['value']);
    }

    public function testGetAutocompleteCitiesByString()
    {
        $this->addRateFactories();

        $result = RateService::getAutocompleteCitiesByString('New York', 10);
        $this->assertCount(2, $result);
        $this->assertEquals('New York, NY 10001', $result[0]['label']);
        $this->assertEquals('New Yorker, NY 10002', $result[1]['label']);

        $result = RateService::getAutocompleteCitiesByString('New York, N', 10);
        $this->assertCount(2, $result);
        $this->assertEquals('New York, NY 10001', $result[0]['label']);
        $this->assertEquals('New Yorker, NY 10002', $result[1]['label']);

        $result = RateService::getAutocompleteCitiesByString('New York, NY', 10);
        $this->assertCount(2, $result);
        $this->assertEquals('New York, NY 10001', $result[0]['label']);
        $this->assertEquals('New Yorker, NY 10002', $result[1]['label']);

        $result = RateService::getAutocompleteCitiesByString('New York, NY 1000', 10);
        $this->assertCount(2, $result);
        $this->assertEquals('New York, NY 10001', $result[0]['label']);
        $this->assertEquals('New Yorker, NY 10002', $result[1]['label']);

        $result = RateService::getAutocompleteCitiesByString('New York, NY 10001', 10);
        $this->assertCount(1, $result);
        $this->assertEquals('New York, NY 10001', $result[0]['label']);
    }
}
