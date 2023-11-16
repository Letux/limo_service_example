<?php

namespace App\Services;

use App\Data\Address;
use App\Repositories\RatesRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

final readonly class RateService
{
    public static function getAutocompleteCities(string $address, int $limit): array
    {
        // Starts from ZIP
        if (preg_match('/^\d+/', $address)) {
            return self::getAutocompleteCitiesByZip($address, $limit);
        }

        return self::getAutocompleteCitiesByString($address, $limit);
    }

    public static function getAutocompleteCitiesByZip(int $zip, int $limit): array
    {
        $zips = RatesRepository::getCitiesByZipLike($zip, $limit);

        // If empty try soundex
        if ($zips->isEmpty()) {
            $zips = RatesRepository::getCitiesByZipSoundsLike($zip, $limit);
        }

        return self::getAutocompleteResult($zips);
    }

    public static function getAutocompleteCitiesByString(string $addressString, int $limit): array
    {
        $address = Address::createFromString($addressString);

        $cities = RatesRepository::getAutocompleteCitiesCollection($address, $limit);

        // If got less then $limit try to use SOUNDEX
        if ($cities->count() < $limit) {
            $soundsCities = RatesRepository::getAutocompleteCitiesSoundexCollection($address, $limit);

            $cities->merge($soundsCities);
        }

        return self::getAutocompleteResult($cities);
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
}
