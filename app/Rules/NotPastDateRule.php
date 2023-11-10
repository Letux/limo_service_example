<?php

namespace App\Rules;

use App\Services\OrderService;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

final readonly class NotPastDateRule extends OrderStep1Rule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        [$minDate, ,] = OrderService::getStep1TimeSettings();
        $pickupTime = $this->getPickUpTime()->startOfDay();

        $minimalDate = now()->startOfDay();
        if ($minDate) {
            $minimalDate->addDay();
        }

        if ($minimalDate.greaterThan($pickupTime)) {
            $fail('This date cannot be in the past');
        }
    }
}
