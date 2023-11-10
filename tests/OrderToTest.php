<?php
use Tests\TestCase;
use App\Enums\OrderTo;

class OrderToTest extends TestCase
{

    public function testListForSelect()
    {
        $this->assertEquals(
            [
                1 => 'To Airport',
                2 => 'From Airport',
                3 => 'Point to Point',
                4 => 'Hourly Charter'
            ],
            OrderTo::listForSelect()
        );
    }
}
