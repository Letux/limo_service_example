<?php

namespace App\Enums;

use EmreYarligan\EnumConcern\EnumConcern;

/**
 * @method static caseByValue(int $value): OrderTo
 */
enum OrderTo: int
{
    use EnumConcern;

    case TO_AIRPORT = 1;
    case FROM_AIRPORT = 2;
    case POINT_TO_POINT = 3;
    case HOURLY_CHARTER = 4;

    public static function listForSelect() : array
    {
        return [
            1 => 'To Airport',
            2 => 'From Airport',
            3 => 'Point to Point',
            4 => 'Hourly Charter'
        ];
    }
}
