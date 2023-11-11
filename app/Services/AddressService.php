<?php

namespace App\Services;

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
}
