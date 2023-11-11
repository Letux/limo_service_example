<?php

namespace App\Rules;

use App\Enums\AirportEnum;
use App\Enums\OrderTo;
use App\Models\ZipCode;
use App\Services\AddressService;
use App\Services\OrderService;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Carbon;

final readonly class MinHourRule extends OrderStep1Rule implements ValidationRule, DataAwareRule
{
    /**
     * @throws \Exception
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->isValid()) {
            $fail("Too short of a notice. Please call our reservation desk in order to have this order served properly. Alternatively double-check the pickup date.");
        }
    }

    /**
     * @throws \Exception
     */
    public function isValid(): bool
    {
        $orderTo = OrderTo::caseByValue($this->data->to);

        [, $minHour, $minDay] = OrderService::getStep1TimeSettings();
        $pickupTime = Carbon::createFromFormat('m/d/Y H:i', "{$this->data->date} {$this->data->hour}:{$this->data->minutes}");

        if ($pickupTime->startOfDay()->lessThan($minDay)) {
            return false;
        } elseif ($pickupTime->startOfDay()->greaterThan($minDay)) {
            return true;
        }

        // Если ZIP введён, вычисляем время пути от Охары до ZIP
        if ($orderTo === OrderTo::FROM_AIRPORT) {
            if ($this->data->from_airport === AirportEnum::Midway) {
                $hours2ZIP = \setting('time_ohara_to_midway');
            } elseif ($this->data->from_airport === AirportEnum::OHare) {
                $hours2ZIP = 0;
            } else {
                throw new \Exception('Unknown airport');
            }
        } else {
            $zip = AddressService::getZip($this->data->pickup_address);
            $hours2ZIP = ZipCode::getHoursFormORD($zip);
        }

        $minTime = today()->setHour($minHour)->setMinute($this->data->minutes)->addHours($hours2ZIP);

        return $pickupTime->greaterThan($minTime);
    }
}
