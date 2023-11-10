<?php

namespace App\Rules;

use App\DTOs\OrderStep1ValidatedData;
use Illuminate\Support\Carbon;

readonly class OrderStep1Rule
{
    protected OrderStep1ValidatedData $data;

    public function setData(array $data): static
    {
        $this->data = OrderStep1ValidatedData::from($data);
        return $this;
    }

    public function getPickUpTime(): false|Carbon
    {
        return Carbon::createFromFormat('m/d/Y H:i', "{$this->data->date} {$this->data->hour}:{$this->data->minutes}");
    }
}
