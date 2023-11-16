<?php

namespace App\Repositories;

use App\Data\Address;
use App\Models\Rate;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

final class RatesRepository
{
    public static function getIdByAddress(string $addressString): ?int
    {
        $address = Address::createFromString($addressString);

        return Rate
            ::where('town', $address->city)
            ->where('zip', $address->zip)
            ->value('id');
    }

    public static function getAutocompleteCitiesCollection(Address $address, int $limit): Collection
    {
        $query = Rate
            ::select(['zip', 'town', 'state'])
            ->limit($limit);

        // Just city in the address
        if (empty($address->state)) {
            self::addLikeWhere($query, 'town', $address->city);
        } // Without zip
        elseif (empty($address->zip)) {
            self::addWhereConditionsWithoutZip($query, $address);
        } else {
            self::addWhereConditionsFullAddress($query, $address);
        }

        return $query->get();
    }

    public static function getAutocompleteCitiesSoundexCollection(Address $address, $limit): Collection
    {
        $query = Rate
            ::select(['zip', 'town', 'state'])
            ->limit($limit);

        // Just city in the address
        if (empty($address->state)) {
            self::addSoundexWhere($query, 'town', $address->city);
        } // Without zip
        elseif (empty($address->zip)) {
            self::addWhereSoundexConditionsWithoutZip($query, $address);
        } else {
            self::addSoundexWhereConditionsFullAddress($query, $address);
        }

        return $query->get();
    }

    public static function getCitiesByZipLike(int $zip, int $limit): Collection
    {
        return Rate
            ::select(['zip', 'town', 'state'])
            ->where('zip', 'LIKE', $zip . '%')
            ->limit($limit)
            ->get();
    }

    public static function getCitiesByZipSoundsLike(int $zip, int $limit): Collection
    {
        return Rate
            ::select(['zip', 'town', 'state'])
            ->where('zip', 'SOUNDS LIKE', $zip . '%')
            ->limit($limit)
            ->get();
    }

    private static function addSoundexWhere(Builder $query, string $field, string $value): void
    {
        $query->where($field, 'SOUNDS LIKE', $value . '%');
    }

    private static function addLikeWhere(Builder $query, string $field, string $value): void
    {
        $query->where($field, 'LIKE', $value . '%');
    }

    public static function addWhereSoundexConditionsWithoutZip(Builder $query, Address $address): void
    {
        if (strlen($address->state) === 1) {
            self::addSoundexWhere($query, 'town', $address->city);
            self::addLikeWhere($query, 'state', $address->state);
        } else {
            self::addSoundexWhere($query, 'town', $address->city);
            $query->where('state', $address->state);
        }
    }

    public static function addSoundexWhereConditionsFullAddress(Builder $query, Address $address): void
    {
        self::addSoundexWhere($query, 'town', $address->city);
        self::addLikeWhere($query, 'state', $address->state);
        self::addLikeWhere($query, 'zip', $address->zip);
    }

    public static function addWhereConditionsWithoutZip(Builder $query, Address $address): void
    {
        if (strlen($address->state) === 1) {
            self::addLikeWhere($query, 'town', $address->city);
            self::addLikeWhere($query, 'state', $address->state);
        } else {
            self::addLikeWhere($query, 'town', $address->city);
            $query->where('state', $address->state);
        }
    }

    public static function addWhereConditionsFullAddress(Builder $query, Address $address): void
    {
        self::addLikeWhere($query, 'town', $address->city);
        self::addLikeWhere($query, 'state', $address->state);
        self::addLikeWhere($query, 'zip', $address->zip);
    }
}
