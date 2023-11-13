<?php

namespace App\Repositories;

use App\Data\Address;
use App\Models\Rate;
use App\Services\AddressService;
use Illuminate\Database\Eloquent\Collection;

final class RatesRepository
{

    public static function getAutocompleteCities(string $address, int $limit): array
    {
        // Starts from ZIP
        if (preg_match('/^\d+/', $address)) {
            return self::getAutocompleteCitiesByZip($address, $limit);
        }

        return self::getAutocompleteCitiesByString($address, $limit);
    }

    public static function getAutocompleteResult(Collection $zips): array
    {
        $result = [];
        foreach ($zips as $zip) {
            $address = $zip->town . ', ' . $zip->state . ' ' . $zip->zip;
            $result[] = [
                'label' => $address,
                'value' => $address
            ];
        }

        return $result;
    }

    public static function getAutocompleteCitiesByZip(int $zip, int $limit): array
    {
        $zips = Rate
            ::select(['zip', 'town', 'state'])
            ->where('zip', 'LIKE', $zip . '%')
            ->limit($limit)
            ->get();

        // If empty try soundex
        if ($zips->isEmpty()) {
            $zips = Rate
                ::select(['zip', 'town', 'state'])
                ->where('zip', 'SOUNDS LIKE', $zip . '%')
                ->limit($limit)
                ->get();
        }

        return self::getAutocompleteResult($zips);
    }

    public static function getIdByAddress(string $addressString): int
    {
        $address = AddressService::getObjectFromString($addressString);

        return Rate
            ::where('town', $address->city)
            ->where('zip', $address->zip)
            ->value('id');
    }

    public static function getAutocompleteCitiesByString(string $addressString, int $limit): array
    {
        $address = AddressService::getObjectFromString($addressString);

        $cities = self::getAutocompleteCitiesCollection($address, $limit);

        // If got less then $limit try to use SOUNDEX
        if ($cities->count() < $limit) {
            $soundsCities = self::getAutocompleteCitiesSoundexCollection($address, $limit);

            $cities->merge($soundsCities);
            $cities = $cities->unique();
        }

        return self::getAutocompleteResult($cities);
    }

    public static function getAutocompleteCitiesSoundexCollection($address, $limit): Collection
    {
        $query = Rate
            ::select(['zip', 'town', 'state'])
            ->limit($limit);

        // Just city in the address
        if (empty($address->state)) {
            $query->where('town', 'SOUNDS LIKE', $address->city . '%');
        } // Without zip
        elseif (empty($address->zip)) {
            if (strlen($address->state) === 1) {
                $query
                    ->where('town', 'SOUNDS LIKE', $address->city . '%')
                    ->where('state', 'LIKE', $address->state . '%');
            } else {
                $query
                    ->where('town', 'SOUNDS LIKE', $address->city . '%')
                    ->where('state', $address->state);
            }
        } else {
            $query
                ->where('town', 'SOUNDS LIKE', $address->city . '%')
                ->where('state', 'LIKE', $address->state . '%')
                ->where('zip', 'LIKE', $address->zip . '%');
        }

        return $query->get();
    }

    public static function getAutocompleteCitiesCollection(Address $address, int $limit): Collection
    {
        $query = Rate
            ::select(['zip', 'town', 'state'])
            ->limit($limit);

        // Just city in the address
        if (empty($address->state)) {
            $query->where('town', 'LIKE', $address->city . '%');
        } // Without zip
        elseif (empty($address->zip)) {
            if (strlen($address->state) === 1) {
                $query
                    ->where('town', 'LIKE', $address->city . '%')
                    ->where('state', 'LIKE', $address->state . '%');
            } else {
                $query
                    ->where('town', 'LIKE', $address->city . '%')
                    ->where('state', $address->state);
            }
        } else {
            $query
                ->where('town', 'LIKE', $address->city . '%')
                ->where('state', 'LIKE', $address->state . '%')
                ->where('zip', 'LIKE', $address->zip . '%');
        }

        return $query->get();
    }
}
