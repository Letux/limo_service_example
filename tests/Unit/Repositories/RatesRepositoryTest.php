<?php

namespace Tests\Unit\Repositories;

use App\Data\Address;
use App\Models\Rate;
use App\Repositories\RatesRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class RatesRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function testGetIdByAddress(): void
    {
        $rate = Rate::factory()->create([
            'town' => 'New York',
            'zip' => '10001',
        ]);

        $this->assertEquals($rate->id, RatesRepository::getIdByAddress('New York, NY 10001'));

        $this->assertNull(RatesRepository::getIdByAddress('New York1, NY 10001'));
        $this->assertNull(RatesRepository::getIdByAddress('New York, NY 10002'));
    }

    public function testGetAutocompleteCitiesCollectionAddressOnly(): void
    {
        $this->addRateFactories();

        $address = new Address('New York', '', '');

        $result = RatesRepository::getAutocompleteCitiesCollection($address, 10);

        $this->assertCount(2, $result);
        $this->assertEquals('New York', $result[0]->town);
        $this->assertEquals('New Yorker', $result[1]->town);
    }

    public function testGetAutocompleteCitiesCollectionWithoutZIP(): void
    {
        $this->addRateFactories();

        $address = new Address('New York', 'N', '');

        $result = RatesRepository::getAutocompleteCitiesCollection($address, 10);

        $this->assertCount(2, $result);
        $this->assertEquals('New York', $result[0]->town);
        $this->assertEquals('New Yorker', $result[1]->town);
    }

    public function testGetAutocompleteCitiesCollectionFullAddress(): void
    {
        $this->addRateFactories();

        $address = new Address('New York', 'NY', '100');

        $result = RatesRepository::getAutocompleteCitiesCollection($address, 10);

        $this->assertCount(2, $result);
        $this->assertEquals('New York', $result[0]->town);
        $this->assertEquals('New Yorker', $result[1]->town);
    }

    public function testAddSoundexWhereConditionsWithoutZip()
    {
        $query = Rate::select(['zip', 'town', 'state']);
        $address = new Address('New York', 'N', '10001');

        RatesRepository::addWhereSoundexConditionsWithoutZip($query, $address);

        $this->assertEquals(
            'select `zip`, `town`, `state` from `rates` where `town` SOUNDS LIKE ? and `state` LIKE ?',
            $query->toSql()
        );
        $this->assertEquals(['New York%', 'N%'], $query->getBindings());

        $query = Rate::select(['zip', 'town', 'state']);
        $address->state = 'NY';
        RatesRepository::addWhereSoundexConditionsWithoutZip($query, $address);

        $this->assertEquals(
            'select `zip`, `town`, `state` from `rates` where `town` SOUNDS LIKE ? and `state` = ?',
            $query->toSql()
        );
        $this->assertEquals(['New York%', 'NY'], $query->getBindings());
    }

    public function testAddSoundexWhereConditionsFullAddress()
    {
        $query = Rate::select(['zip', 'town', 'state']);
        $address = new Address('New York', 'NY', '10001');

        RatesRepository::addSoundexWhereConditionsFullAddress($query, $address);

        $this->assertEquals(
            'select `zip`, `town`, `state` from `rates` where `town` SOUNDS LIKE ? and `state` LIKE ? and `zip` LIKE ?',
            $query->toSql()
        );
        $this->assertEquals(['New York%', 'NY%', '10001%'], $query->getBindings());
    }

    public function testAddWhereConditionsWithoutZip()
    {
        $query = Rate::select(['zip', 'town', 'state']);
        $address = new Address('New York', 'N', '10001');

        RatesRepository::addWhereConditionsWithoutZip($query, $address);

        $this->assertEquals(
            'select `zip`, `town`, `state` from `rates` where `town` LIKE ? and `state` LIKE ?',
            $query->toSql()
        );
        $this->assertEquals(['New York%', 'N%'], $query->getBindings());

        $query = Rate::select(['zip', 'town', 'state']);
        $address->state = 'NY';

        RatesRepository::addWhereConditionsWithoutZip($query, $address);

        $this->assertEquals(
            'select `zip`, `town`, `state` from `rates` where `town` LIKE ? and `state` = ?',
            $query->toSql()
        );
        $this->assertEquals(['New York%', 'NY'], $query->getBindings());
    }

    public function testAddWhereConditionsFullAddress()
    {
        $query = Rate::select(['zip', 'town', 'state']);
        $address = new Address('New York', 'NY', '10001');

        RatesRepository::addWhereConditionsFullAddress($query, $address);

        $this->assertEquals(
            'select `zip`, `town`, `state` from `rates` where `town` LIKE ? and `state` LIKE ? and `zip` LIKE ?',
            $query->toSql()
        );
        $this->assertEquals(['New York%', 'NY%', '10001%'], $query->getBindings());
    }

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

    public function testGetCitiesByZipLike()
    {
        $this->addRateFactories();

        $result = RatesRepository::getCitiesByZipLike(100, 10);
        $this->assertCount(2, $result);
        $this->assertEquals('New York', $result[0]->town);
        $this->assertEquals('New Yorker', $result[1]->town);
    }
}
