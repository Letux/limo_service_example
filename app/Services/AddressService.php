<?php

namespace App\Services;

use App\Data\Address;

class AddressService
{
    /**
     * @param string $address
     * @return string|null
     */
    public static function getZip(string $address): ?string
    {
        preg_match('/\b\d{5}\b/', $address, $dropOffZip);
        return $dropOffZip[0] ?? null;
    }

    public static function containsZip(string $address): false|int
    {
        return preg_match('/\b\d{5}\b/', $address);
    }

    public static function getObjectFromString(string $address): Address
    {
        $address = trim($address);
        $address = str_replace('  ', ' ', $address);

        $address = explode(',', $address);

        $city = trim($address[0]);
        $stateZip = trim($address[1] ?? null);

        $stateZip = explode(' ', $stateZip);

        $state = trim($stateZip[0] ?? null);
        $zip = trim($stateZip[1] ?? null);

        return new Address($city, $state, $zip);
    }
}
