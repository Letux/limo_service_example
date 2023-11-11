<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZipCode extends Model
{
    use HasFactory;

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    protected $casts = [
        'created' => 'datetime',
        'modified' => 'datetime',
    ];

    public static function getHoursFormORD(string $zip): int
    {
        $time = self::where('ZipCode', $zip)->value('timeORD');

        if (preg_match('/^(\\d+) hour.*/', $time, $time)) {
            return $time[1];
        } else {
            return 0;
        }
    }

    public static function isExisted(int $zip): bool
    {
        return self::where('id', $zip)->exists();
    }
}
