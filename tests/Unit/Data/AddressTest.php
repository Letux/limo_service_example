<?php

namespace Tests\Unit\Data;

use App\Data\Address;
use PHPUnit\Framework\TestCase;

final class AddressTest extends TestCase
{
    public function testCreateFromString()
    {
        $address = Address::createFromString('New    York  ,    NY   10001 ');
        $this->assertEquals('New York', $address->city);
        $this->assertEquals('NY', $address->state);
        $this->assertEquals('10001', $address->zip);

        $address = Address::createFromString('New    York  ,    NY   1 ');
        $this->assertEquals('New York', $address->city);
        $this->assertEquals('NY', $address->state);
        $this->assertEquals('1', $address->zip);

        $address = Address::createFromString('New York, NY');
        $this->assertEquals('New York', $address->city);
        $this->assertEquals('NY', $address->state);
        $this->assertNull($address->zip);

        $address = Address::createFromString('New York, N');
        $this->assertEquals('New York', $address->city);
        $this->assertEquals('N', $address->state);
        $this->assertNull($address->zip);

        $address = Address::createFromString('New York, ');
        $this->assertEquals('New York', $address->city);
        $this->assertNull($address->state);
        $this->assertNull($address->zip);

        $address = Address::createFromString('New York');
        $this->assertEquals('New York', $address->city);
        $this->assertNull($address->state);
        $this->assertNull($address->zip);
    }

    public function testCleanAddressString()
    {
        $address = Address::cleanAddressString(' New    York  ,    NY   10001 ');
        $this->assertEquals('New York , NY 10001', $address);
    }
}
