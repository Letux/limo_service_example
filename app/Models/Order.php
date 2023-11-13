<?php

namespace App\Models;

use App\DTOs\OrderStep1ValidatedData;
use App\Enums\OrderStatus;
use App\Enums\OrderTo;
use App\Repositories\RatesRepository;
use App\Services\AddressService;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Order extends Model
{
    use HasFactory;

    public $timestamps = ['created', 'modified'];

    protected $fillable = [];

    protected $fillableStep1 = [
        'to',
        'pass_number',
        'date',
        'pickup_time',
        'pickup_address',
        'dropoff_address',
    ];

    protected $casts = [
        'to' => OrderTo::class,
        'status' => OrderStatus::class,
        'pickup_time' => 'datetime',
        'dropoff_time' => 'datetime',
        'expiration_date' => 'datetime',
        'created' => 'datetime',
        'modified' => 'datetime',
    ];

    public static array $hours = [
        1 => '1 AM',
        2 => '2 AM',
        3 => '3 AM',
        4 => '4 AM',
        5 => '5 AM',
        6 => '6 AM',
        7 => '7 AM',
        8 => '8 AM',
        9 => '9 AM',
        10 => '10 AM',
        11 => '11 AM',
        12 => '12 Noon',
        13 => '1 PM',
        14 => '2 PM',
        15 => '3 PM',
        16 => '4 PM',
        17 => '5 PM',
        18 => '6 PM',
        19 => '7 PM',
        20 => '8 PM',
        21 => '9 PM',
        22 => '10 PM',
        23 => '11 PM',
        0 => '12 Midnight'
    ];

    public static array $minutes = [
        '00' => ':00',
        '15' => ':15',
        '30' => ':30',
        '45' => ':45'
    ];

    public static $charterMinutes = array(
        '15' => '15 minutes',
        '30' => '30 minutes',
        '45' => '45 minutes',
        '60' => '1 hour',
        '75' => '1 hour 15 minutes',
        '90' => '1 hour 30 minutes',
        '105' => '1 hour 45 minutes',
        '120' => '2 hours',
        '135' => '2 hours 15 minutes',
        '150' => '2 hours 30 minutes',
        '165' => '2 hours 45 minutes',
        '180' => '3 hours',
        '195' => '3 hours 15 minutes',
        '210' => '3 hours 30 minutes',
        '225' => '3 hours 45 minutes',
        '240' => '4 hours',
        '255' => '4 hours 15 minutes',
        '270' => '4 hours 30 minutes',
        '285' => '4 hours 45 minutes',
        '300' => '5 hours',
        '315' => '5 hours 15 minutes',
        '330' => '5 hours 30 minutes',
        '345' => '5 hours 45 minutes',
        '360' => '6 hours',
        '375' => '6 hours 15 minutes',
        '390' => '6 hours 30 minutes',
        '405' => '6 hours 45 minutes',
        '420' => '7 hours',
        '435' => '7 hours 15 minutes',
        '450' => '7 hours 30 minutes',
        '465' => '7 hours 45 minutes',
        '480' => '8 hours',
        '495' => '8 hours 15 minutes',
        '510' => '8 hours 30 minutes',
        '525' => '8 hours 45 minutes',
        '540' => '9 hours',
        '555' => '9 hours 15 minutes',
        '570' => '9 hours 30 minutes',
        '585' => '9 hours 45 minutes',
        '600' => '10 hours',
        '615' => '10 hours 15 minutes',
        '630' => '10 hours 30 minutes',
        '645' => '10 hours 45 minutes',
        '660' => '11 hours',
        '675' => '11 hours 15 minutes',
        '690' => '11 hours 30 minutes',
        '705' => '11 hours 45 minutes',
        '720' => '12 hours',
        '735' => '12 hours 15 minutes',
        '750' => '12 hours 30 minutes',
        '765' => '12 hours 45 minutes',
        '780' => '13 hours',
        '795' => '13 hours 15 minutes',
        '810' => '13 hours 30 minutes',
        '825' => '13 hours 45 minutes',
        '840' => '14 hours',
        '855' => '14 hours 15 minutes',
        '870' => '14 hours 30 minutes',
        '885' => '14 hours 45 minutes',
        '900' => '15 hours',
        '915' => '15 hours 15 minutes',
        '930' => '15 hours 30 minutes',
        '945' => '15 hours 45 minutes',
        '960' => '16 hours',
        '975' => '16 hours 15 minutes',
        '990' => '16 hours 30 minutes',
        '1005' => '16 hours 45 minutes',
        '1020' => '17 hours',
        '1035' => '17 hours 15 minutes',
        '1050' => '17 hours 30 minutes',
        '1065' => '17 hours 45 minutes',
        '1080' => '18 hours',
        '1095' => '18 hours 15 minutes',
        '1110' => '18 hours 30 minutes',
        '1125' => '18 hours 45 minutes',
        '1140' => '19 hours',
        '1155' => '19 hours 15 minutes',
        '1170' => '19 hours 30 minutes',
        '1185' => '19 hours 45 minutes',
        '1200' => '20 hours',
        '1215' => '20 hours 15 minutes',
        '1230' => '20 hours 30 minutes',
        '1245' => '20 hours 45 minutes',
        '1260' => '21 hours',
        '1275' => '21 hours 15 minutes',
        '1290' => '21 hours 30 minutes',
        '1305' => '21 hours 45 minutes',
        '1320' => '22 hours',
        '1335' => '22 hours 15 minutes',
        '1350' => '22 hours 30 minutes',
        '1365' => '22 hours 45 minutes',
        '1380' => '23 hours',
        '1395' => '23 hours 15 minutes',
        '1410' => '23 hours 30 minutes',
        '1425' => '23 hours 45 minutes'
    );

    protected function pickUpDate(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->pickup_time->format('m/d/Y');
            },
        );
    }

    protected function pickUpDateMobile(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->pickup_time->format('Y-m-d');
            },
        );
    }

    protected function pickUpHour(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->pickup_time->format('H');
            },
        );
    }

    protected function pickUpMinutes(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->pickup_time->format('m');
            },
        );
    }

    public static function getCharterMinutes(int $minCharterHours): array
    {
        $charterMinutes = self::$charterMinutes;

        for ($i = 15; $i < $minCharterHours * 60; $i += 15) {
            unset($charterMinutes["$i"]);
        }

        return $charterMinutes;
    }

    /**
     * @throws \Exception
     * @throws \Throwable
     */
    public static function prepareOnStep1(OrderStep1ValidatedData $data, string $userCameFrom, string $domain): self
    {
        $order = new self();

        $order->fillable($order->fillableStep1);
        $order->fill($data->toArray());

        $order->status = OrderStatus::NOT_ENDED;
        $order->user_id = auth()->id();
        $order->pickup_time = $order->makePickupTime($data->date, $data->hour, $data->minutes);
        $order->setRateId();
        $order->setAirportId($data->to_airport ?? null, $data->from_airport ?? null);
        $order->setPickUpZip();
        $order->setDropOffTime($data->charter_minutes);
        $order->setDropOffZip();
        $order->trace_path = $userCameFrom;
        $order->site = $domain;

        return $order;
    }

    public function makePickupTime(string $date, int $hour, int $minutes): Carbon
	{
		return Carbon::createFromFormat('m/d/Y', $date)->setHour($hour)->setMinute($minutes);
	}

    /**
     * @throws \Exception
     * @throws \Throwable
     */
    public function setRateId(): void
    {
        throw_if($this->to === null, new \Exception('Order to is null'));

        if ($this->to === OrderTo::TO_AIRPORT) {
            $this->rate_id = RatesRepository::getIdByAddress($this->pickup_address);
        } elseif ($this->to == OrderTo::FROM_AIRPORT) {
            $this->rate_id = RatesRepository::getIdByAddress($this->dropoff_address);
        }
    }

    /**
     * @throws \Exception
     * @throws \Throwable
     */
    public function setAirportId(?int $to_airport, ?int $from_airport): void
    {
        throw_if($this->to === null, new \Exception('Order to is null'));

        $this->airport_id = ($this->to === OrderTo::TO_AIRPORT) ? $to_airport : $from_airport;
    }

    /**
     * @throws \Exception
     * @throws \Throwable
     */
    public function setPickUpZip(): void
    {
        throw_if($this->to === null, new \Exception('Order to is null'));
        throw_if($this->airport_id === null, new \Exception('Order airport_id is null'));

        if ($this->to === OrderTo::FROM_AIRPORT) {
            $this->pickup_zip = Airport::find($this->airport_id)->zip;
        } else {
            throw_if($this->pickup_address === null, new \Exception('Order pickup_address is null'));
            $this->pickup_zip = AddressService::getZip($this->pickup_address);
        }
    }

    /**
     * @throws \Exception
     * @throws \Throwable
     */
    public function setDropOffTime(int $charter_minutes): void
    {
        if ($this->to === OrderTo::HOURLY_CHARTER) {
            throw_if($this->pickup_time === null, new \Exception('Order pickup_time is null'));

            $pickUpTime = $this->pickup_time->clone();
			$this->dropoff_time = $pickUpTime->addMinutes($charter_minutes);
		}
    }

    /**
     * @throws \Throwable
     */
    public function setDropOffZip(): void
    {
        throw_if($this->to === null, new \Exception('Order to is null'));

        if (in_array($this->to, [OrderTo::FROM_AIRPORT, OrderTo::POINT_TO_POINT])) {
            throw_if($this->dropoff_address === null, new \Exception('Order dropoff_address is null'));
            $this->dropoff_zip = AddressService::getZip($this->dropoff_address);
        } elseif ($this->to === OrderTo::TO_AIRPORT) {
            throw_if($this->airport_id === null, new \Exception('Order airport_id is null'));
            $this->dropoff_zip = Airport::find($this->airport_id)->zip;
        }
    }

}
