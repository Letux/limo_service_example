<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Setting extends Model
{
    public $timestamps = false;

    protected $table = 'variables';

    protected $fillable = [
        'property_name',
        'value',
        'coments',
        'order',
    ];

    protected static Collection $settings;

    public static function getSetting(string $name, mixed $default)
    {
        if (empty(self::$settings)) {
            self::$settings = cache()->remember(
                'settings',
                60 * 60 * 24,
                fn() => self::all()->keyBy('property_name')
            );
        }

        return self::$settings[$name]->value ?? $default;
    }
}
