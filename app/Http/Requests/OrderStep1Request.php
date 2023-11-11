<?php

namespace App\Http\Requests;

use App\DTOs\OrderStep1ValidatedData;
use App\Enums\OrderTo;
use App\Repositories\AirportsRepository;
use App\Rules\MinHourRule;
use App\Rules\NotPastDateRule;
use App\Rules\NotPastHourRule;
use App\Rules\ZipCodeExistsRule;
use App\Services\AddressService;
use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

final  class OrderStep1Request extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'date' => self::fixMobileDate($this->date),
        ]);
    }

    public function rules(): array
    {
        return [
            'id' => ['nullable', 'integer'],
            'return_from' => ['nullable', 'integer'],
            'similar_order_id' => ['nullable', 'integer'],
            'to' => ['required', 'integer', Rule::in(OrderTo::allToArray())],
            'pass_number' => ['required', 'integer'],
            'date' => ['required', 'date', NotPastDateRule::class],
            'hour' => ['required', 'integer', 'min:1', 'max:24'],
            'minutes' => ['required', 'integer', 'min:0', 'max:59', NotPastHourRule::class, MinHourRule::class],
            'charter_minutes' => [
                'nullable',
                'integer',
                function (string $attribute, mixed $value, Closure $fail) {
                    if ($value / 60 < (int)setting('hourly_charter_min_hours')) {
                        $fail("The minimum number of hours for the hourly charter is not met");
                    }
                }
            ],
            'from_airport' => ['nullable', 'integer', Rule::in(AirportsRepository::getIdArray())],
            'pickup_address' => ['nullable', [self::class, 'zipRequired'], ZipCodeExistsRule::class],
            'to_airport' => ['nullable', 'integer', Rule::in(AirportsRepository::getIdArray())],
            'dropoff_address' => ['nullable', [self::class, 'zipRequired'], ZipCodeExistsRule::class],
        ];
    }

    public function validated($key = null, $default = null): OrderStep1ValidatedData
    {
        $validated = parent::validated();

        return OrderStep1ValidatedData::from($validated);
    }

    public static function fixMobileDate(string $date): string
    {
        if (str_contains($date, '-')) {
            return Carbon::createFromFormat('Y-m-d', $date)->format('m/d/Y');
        }

        return $date;
    }

    public function zipRequired(string $attribute, mixed $value, Closure $fail): void
    {
        if (!AddressService::containsZip($value)) {
            $fail('We really need this ZIP code to proceed');
        }
    }
}
