<?php

namespace App\Rules;

use App\Models\ZipCode;
use App\Services\AddressService;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

final class ZipCodeExistsRule implements ValidationRule
{
    public function validate(string $attribute, $value, Closure $fail): void
    {
        if (empty($value)) {
            return;
        }

        $zip = AddressService::getZip($value);
        if ($zip === null) {
            return;
        }

        if (!ZipCode::isExisted($zip)) {
            $fail('The zip code you have entered cannot be located or does not belong to service area (IL, IA, IN, MI, KY, MS, MO, MN, OH, WI). Please check the zip code and Try again. If you still receive the message, try an adjacent zip code or call us on the office number above.');
        }
    }
}
