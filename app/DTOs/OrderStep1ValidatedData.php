<?php

namespace App\DTOs;

use App\Enums\OrderTo;
use Spatie\LaravelData\Data;

class OrderStep1ValidatedData extends Data
{
    public function __construct(
        public ?int $id,
        public ?int $return_from,
        public ?int $similar_order_id,
        public int $to,
        public int $pass_number,
        public string $date,
        public int $hour,
        public int $minutes,
        public ?int $charter_minutes,
        public ?int $from_airport,
        public ?string $pickup_address,
        public ?int $to_airport,
        public ?string $dropoff_address,
    )
    {

    }
}
