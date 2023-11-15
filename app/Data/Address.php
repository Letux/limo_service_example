<?php

namespace App\Data;

class Address
{
    public function __construct(public ?string $city, public ?string $state, public ?string $zip)
    {

    }

    public static function createFromString(string $address): Address
    {
        $address = self::cleanAddressString($address);

        $result = preg_match('/^([\w\s]+)\s*,\s*(\w{2}) (\d{5})$/', $address, $matches);

        if ($result === 1) {
            return new Address(trim($matches[1]), $matches[2], $matches[3]);
        }

        $result = preg_match('/^([\w\s]+)\s*,\s*(\w{2})$/', $address, $matches);

        if ($result === 1) {
            return new Address(trim($matches[1]), $matches[2], null);
        }

        $result = preg_match('/^([\w\s]+)\s*,$/', $address, $matches);

        if ($result === 1) {
            return new Address(trim($matches[1]), null, null);
        }

        $result = preg_match('/^([\w\s]+)$/', $address, $matches);

        if ($result === 1) {
            return new Address(trim($matches[1]), null, null);
        }

        return new Address(null, null, null);
    }

    public static function cleanAddressString(string $address): string
    {
        $address = trim($address);
        return preg_replace('/\s+/', ' ', $address);
    }
}
