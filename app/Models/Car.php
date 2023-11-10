<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

//    protected $casts = [
//        'created' => 'datetime',
//        'modified' => 'datetime',
//    ];

    public static function getMaxPassengers(): int
    {
        return self::where('visibility', 'yes')->max('pass_number');
    }
}
