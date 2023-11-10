<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    public $timestamps = false;

    protected $fillable = [
        'zip',
        'town',
        'state',
        'short_name',
        'ORD',
        'MDW',
        'MKE',
        'CHI',
        'chicagoland',
        'major_city',
        'url_rates',
        'manual_rate',
        'old_id',
        'created',
        'modified',
    ];

    protected $casts = [
        'chicagoland' => 'boolean',
        'major_city' => 'boolean',
        'created' => 'datetime',
        'modified' => 'datetime',
    ];

    public static function getIdByAddress(string $address) : int
    {
        [$town, $stateZip] = explode(',', $address);
        [, $zip] = explode(' ', trim($stateZip));

        return self
            ::where('town', trim($town))
            ->where('zip', trim($zip))
            ->value('id');
    }
}
