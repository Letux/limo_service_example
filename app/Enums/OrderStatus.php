<?php

namespace App\Enums;

enum OrderStatus: int
{
    case NOT_ENDED = 1;
    case NEW = 2;
    case ACTIVE = 3;
    case COMPLETED = 4;
    case CANCELED = 5;

    public static function listForSelect() : array
    {
        return [
            1 => 'Not ended',
            2 => 'New',
            3 => 'Active',
            4 => 'Completed',
            5 => 'Canceled'
        ];
    }
}
