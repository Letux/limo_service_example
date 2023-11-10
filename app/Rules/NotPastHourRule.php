<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Carbon;

final readonly class NotPastHourRule extends OrderStep1Rule implements DataAwareRule, ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $pickupTime = Carbon::createFromFormat('m/d/Y H:i', "{$this->data->date} {$this->data->hour}:{$this->data->minutes}");

        if (!$pickupTime->greaterThan(now())) {
            $fail("This date cannot be in the past");
        }
    }
}
