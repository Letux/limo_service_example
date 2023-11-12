<?php

namespace Tests\Feature;

use App\Models\ZipCode;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class ZipCodeTest extends TestCase
{
    use RefreshDatabase;

    public function testExists()
    {
        $this->assertFalse(ZipCode::where('id', 77777)->exists());
        $response = $this->get('/api/zip-code-exists/77777');
        $response->assertStatus(200);
        $response->assertJson(['result' => '0']);

        ZipCode::factory()->create(['id' => 77777, 'ZipCode' => 77777]);
        $this->assertTrue(ZipCode::where('id', 77777)->exists());
        $response = $this->get('/api/zip-code-exists/77777');
        $response->assertStatus(200);
        $response->assertJson(['result' => '1']);
    }

    public function testTimeFromOHare()
    {
        $this->seed();

        $address = ZipCode::find(65011);
        $this->assertNotNull($address);
        $this->assertEquals('65011', $address->id);

        $response = $this->post('/api/time-from-ohare', ['address' => '65011']);

        $this->assertEquals(7, $response->json('result'));
    }
}
