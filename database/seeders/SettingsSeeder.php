<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

final class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        Setting::createOrFirst([
            'property_name' => 'night_start',
        ], [
            'value' => '22',
            'coments' => 'Set the hour when the night tariff (night multiplier) starts. Acceptable value range is from 0 to 23.',
            'order' => 91,
        ]);

        Setting::createOrFirst([
            'property_name' => 'night_end',
        ], [
            'value' => '5',
            'coments' => 'Set the hour when the night tariff (night multiplier) stops. Acceptable value range is from 0 to 23.',
            'order' => 92,
        ]);

        Setting::createOrFirst([
            'property_name' => 'luggage',
        ], [
            'value' => '25',
            'coments' => 'Price of luggage meet service',
            'order' => 1,
        ]);

        Setting::createOrFirst([
            'property_name' => 'pre_hours',
        ], [
            'value' => '3',
            'coments' => 'This is the time interval in hours, when the car cannot be reserved. For example if its value is "5" and now is 08:00am. A customer will be able to order a car starting 1:00pm. Before - call only.',
            'order' => 93,
        ]);

        Setting::createOrFirst([
            'property_name' => 'path_width',
        ], [
            'value' => '150',
            'coments' => 'Image width on home page and admin page. It is shown where a list of cars is. In pixels. It is applied during the image upload',
            'order' => 100,
        ]);

        Setting::createOrFirst([
            'property_name' => 'path_height',
        ], [
            'value' => '75',
            'coments' => 'Image height on home page and admin page. It is shown where a list of cars is. In pixels. It is applied during the image upload',
            'order' => 100,
        ]);

        Setting::createOrFirst([
            'property_name' => 'path_ext_width',
        ], [
            'value' => '192',
            'coments' => 'Image width on order page where the description of a car EXterior showing. In pixels. It is applied during image upload',
            'order' => 100,
        ]);

        Setting::createOrFirst([
            'property_name' => 'path_ext_height',
        ], [
            'value' => '150',
            'coments' => 'Image height on order page where the description of a car EXterior showing. In pixels. It is applied during image upload',
            'order' => 100,
        ]);

        Setting::createOrFirst([
            'property_name' => 'path_int_width',
        ], [
            'value' => '192',
            'coments' => 'Image width on order page where the description of a car interior showing. In pixels. It is applied during image upload',
            'order' => 100,
        ]);

        Setting::createOrFirst([
            'property_name' => 'path_int_height',
        ], [
            'value' => '150',
            'coments' => 'Image height on order page where the description of a car interior showing. In pixels. It is applied during image upload',
            'order' => 100,
        ]);

        Setting::createOrFirst([
            'property_name' => 'email',
        ], [
            'value' => 'info@limo-service-example.com',
            'coments' => 'Admin\'s email. All notifications will be sent there.',
            'order' => 100,
        ]);

        Setting::createOrFirst([
            'property_name' => 'holidays',
        ], [
            'value' => '05/29    12/25 11/23  01/01 07/04  04/05 ',
            'coments' => 'Ex.: 12/31 01/01 07/04. Holiday dates when a holiday car multiplier applies. (specify each car multiplier in a car profile)',
            'order' => 90,
        ]);

        Setting::createOrFirst([
            'property_name' => 'email_SMS',
        ], [
            'value' => 'orders@limo-service-example.com',
            'coments' => 'Email address that is responsible for forwarding short copy of the order onto cell phone',
            'order' => 100,
        ]);

        Setting::createOrFirst([
            'property_name' => 'min_tips',
        ], [
            'value' => '10',
            'coments' => 'Minimum tips not to require on last step. The TIPs window will not show, customer cannot change it anymore.',
            'order' => 100,
        ]);

        Setting::createOrFirst([
            'property_name' => 'tax_airport_arrival',
        ], [
            'value' => '4.00',
            'coments' => 'Tax that is added to an airport fee when a person is going FROM an airport',
            'order' => 2,
        ]);

        Setting::createOrFirst([
            'property_name' => 'distance_b4_mandatory_tip',
        ], [
            'value' => '100',
            'coments' => 'Distance after which the tip is added mandatory. Customer cannot change it over this distance',
            'order' => 100,
        ]);

        Setting::createOrFirst([
            'property_name' => 'mandatory_tip_percent',
        ], [
            'value' => '20',
            'coments' => 'Mandatory tip percentage that is added to the total beyond the distance above',
            'order' => 100,
        ]);

        Setting::createOrFirst([
            'property_name' => 'pre_hours_night_start',
        ], [
            'value' => '23',
            'coments' => 'Ex.: now is 21:00. Plus pre_hours = 21+5=2am. If pre_hours_night_start<2am, a customer cannot place an order for 2am. The earliest is pre_hours_night_start+pre_hours',
            'order' => 94,
        ]);

        Setting::createOrFirst([
            'property_name' => 'pre_hours_night_end',
        ], [
            'value' => '5',
            'coments' => 'Ex.: now is 21:00. Plus pre_hours = 21+5=2am. If pre_hours_night_start<2am, a customer cannot place an order for 2am. The earliest is pre_hours_night_start+pre_hours',
            'order' => 94,
        ]);

        Setting::createOrFirst([
            'property_name' => 'hourly_charter_min_hours',
        ], [
            'value' => '2',
            'coments' => 'Minimum number of hours that charter order can be done for',
            'order' => 10,
        ]);

        Setting::createOrFirst([
            'property_name' => 'child_seat',
        ], [
            'value' => '25',
            'coments' => 'Price (dollars) for a child seat or a booster when a customer does not bring their own.',
            'order' => 100,
        ]);

        Setting::createOrFirst([
            'property_name' => 'stops_price',
        ], [
            'value' => '10',
            'coments' => 'Price (dollars) of an additional stop during a point to point ride. Additional stop cannot be further away from the destination than original pickup point.',
            'order' => 100,
        ]);

        Setting::createOrFirst([
            'property_name' => 'p2p_minimal_distance',
        ], [
            'value' => '3',
            'coments' => 'p2p Minimal Distance. Even if they go 50 yards, they will pay for (miles)',
            'order' => 20,
        ]);

        Setting::createOrFirst([
            'property_name' => 'p2p_coordinates_distance_mult',
        ], [
            'value' => '1.2',
            'coments' => 'p2p If the system cannot retrieve the distance and it is not available cached, direct line distance is multiplied by',
            'order' => 21,
        ]);

        Setting::createOrFirst([
            'property_name' => 'p2p_minimal_way_price',
        ], [
            'value' => '50',
            'coments' => 'p2p minimum order amount after all calculations even if a guy next door wants to go to the nearest post office',
            'order' => 22,
        ]);

        Setting::createOrFirst([
            'property_name' => 'siteName',
        ], [
            'value' => 'Limousine Service Example',
            'coments' => '',
            'order' => 100,
        ]);

        Setting::createOrFirst([
            'property_name' => 'auto_rates_min',
        ], [
            'value' => '54',
            'coments' => 'Minimal rate for airports auto rates',
            'order' => 3,
        ]);

        Setting::createOrFirst([
            'property_name' => 'hourly_charter_empty_run_min_miles',
        ], [
            'value' => '20',
            'coments' => 'Distance (mi) that a car can go without charging additional money to arrive. After that per mile rate applies for running empty from the office to the customer.',
            'order' => 11,
        ]);

        Setting::createOrFirst([
            'property_name' => 'hourly_charter_empty_run_multiplier',
        ], [
            'value' => '0.99',
            'coments' => 'Price per mile for empty run from the office to a distant customer after hourly_charter_empty_run_min_miles miles',
            'order' => 12,
        ]);

        Setting::createOrFirst([
            'property_name' => 'adminSMSPhone',
        ], [
            'value' => '+1234567890',
            'coments' => '',
            'order' => 0,
        ]);

        Setting::createOrFirst([
            'property_name' => 'email_sender_ip',
        ], [
            'value' => '127.0.0.1',
            'coments' => 'IP for email sender',
            'order' => 150,
        ]);

        Setting::createOrFirst([
            'property_name' => 'billing_status',
        ], [
            'value' => 'sandbox',
            'coments' => 'Is billing production or sandbox',
            'order' => 200,
        ]);

        Setting::createOrFirst([
            'property_name' => 'fuel_surcharge',
        ], [
            'value' => '10',
            'coments' => 'Fuel surcharge',
            'order' => 160,
        ]);

        Setting::createOrFirst([
            'property_name' => 'sms_sending',
        ], [
            'value' => 'true',
            'coments' => 'SMS sending is enabled',
            'order' => 0,
        ]);
    }

}
