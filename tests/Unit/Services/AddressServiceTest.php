<?php

namespace Tests\Unit\Services;

use App\Services\AddressService;
use PHPUnit\Framework\TestCase;

final class AddressServiceTest extends TestCase
{
    public function testGetZip()
    {
        $zip = AddressService::getZip('6500');
        $this->assertNull($zip);

        $zip = AddressService::getZip('65001');
        $this->assertEquals('65001', $zip);

        $zip = AddressService::getZip('Argyle, MO 65001');
        $this->assertEquals('65001', $zip);

        $zip = AddressService::getZip('Argyle, MO 650010');
        $this->assertNull($zip);
    }

    public function testContainsZip()
    {
        $zip = AddressService::containsZip('6500');
        $this->assertFalse($zip);

        $zip = AddressService::containsZip('65001');
        $this->assertTrue($zip);

        $zip = AddressService::containsZip('Argyle, MO 65001');
        $this->assertTrue($zip);

        $zip = AddressService::containsZip('Argyle, MO 650010');
        $this->assertFalse($zip);
    }
}
