<?php

namespace App\Data;

class Address
{
    public function __construct(public ?string $city, public ?string $state, public ?string $zip)
    {

    }
}
