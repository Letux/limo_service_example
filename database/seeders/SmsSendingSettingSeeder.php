<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

final class SmsSendingSettingSeeder extends Seeder
{
    public function run(): void
    {
        if (Setting::where('property_name', 'sms_sending')->exists()) {
            return;
        }

        Setting::create([
            'property_name' => 'sms_sending',
            'value' => 'true',
            'coments' => 'SMS sending is enabled',
            'order' => 0,
        ]);
    }
}
