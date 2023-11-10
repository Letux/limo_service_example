<?php

namespace App\Repositories;

use App\Models\Airport;
use Illuminate\Support\Collection;

class AirportsRepository
{

    public static function getList(): Collection
    {
        return Airport::orderBy('name')->pluck('name', 'id');
    }

    public static function getIdArray(): array
    {
        return Airport::orderBy('name')->pluck('id')->toArray();
    }
}
