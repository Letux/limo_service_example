<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class RateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'zip' => ['required'],
            'town' => ['required'],
            'state' => ['nullable'],
            'short_name' => ['required'],
            'ORD' => ['required', 'integer'],
            'MDW' => ['required', 'integer'],
            'MKE' => ['required', 'integer'],
            'CHI' => ['required', 'integer'],
            'chicagoland' => ['required'],
            'major_city' => ['required'],
            'url_rates' => ['required'],
            'manual_rate' => ['required'],
            'old_id' => ['nullable', 'integer'],
            'created' => ['required', 'date'],
            'modified' => ['required', 'date'],
        ];
    }
}
