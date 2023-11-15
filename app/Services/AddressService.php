<?php

namespace App\Services;

use App\Data\Address;

final readonly class AddressService
{
    /**
     * @param string $address
     * @return string|null
     */
    public static function getZip(string $address): ?string
    {
        preg_match('/\b\d{5}\b/', $address, $zip);
        return $zip[0] ?? null;
    }

    public static function containsZip(string $address): bool
    {
        return preg_match('/\b\d{5}\b/', $address) === 1;
    }
}
