<?php

namespace App\Services;

use Ankurk91\LaravelAlert\Alert;
use App\DTOs\OrderStep1ValidatedData;
use App\Enums\OrderTo;
use App\Models\Car;
use App\Models\Order;
use App\Repositories\AirportsRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class OrderService
{
    /**
     * @return <int, int, Carbon>
     */
    public function getStep1TimeSettings(): array
    {
        // Min time
        $nightStart = (int)setting('pre_hours_night_start');
        $nightEnd = (int)setting('pre_hours_night_end');
        $preHours = (int)setting('pre_hours');

        if ($this->atNight($nightStart, $nightEnd, $preHours)) {
            if (now()->hour < $nightEnd) {
                $minDate = 0;
            } else {
                $minDate = 1;
            }
            $minHour = $nightEnd + $preHours;
        } else {
            $minDate = 0;
            $minHour = now()->hour + $preHours;
        }

        $minDay = $minDate ? now()->addDay()->startOfDay() : now()->startOfDay();

        return [$minDate, $minHour, $minDay];
    }

    public function atNight(int $nightStart, int $nightEnd, int $preHours): bool
    {
        $hour = now()->hour;

        return $hour >= $nightStart || $hour < $nightEnd || $hour + $preHours >= $nightStart;
    }

    public function step1InitVars(): array
    {
        $maxPassengers = Car::getMaxPassengers();
        $airports = AirportsRepository::getList();
        $holidays = setting('holidays');
        $minCharterHours = (int)setting('hourly_charter_min_hours');
        $to = OrderTo::listForSelect();
        $charterMinutes = Order::getCharterMinutes($minCharterHours);

        return [$maxPassengers, $airports, $holidays, $minCharterHours, $to, $charterMinutes];
    }

    /**
     * @throws \Throwable
     */
    public function step1Handler(OrderStep1ValidatedData $data, string $userCameFrom, string $domain): int|false
    {
        $newOrder = Order::prepareOnStep1($data, $userCameFrom, $domain);

        Log::info('Step 1:' . PHP_EOL . print_r($newOrder, true));

        if ($newOrder->save()) {
            session(['Order.id' => $newOrder->id]);
            Log::info('Step 1 (Saved) :' . PHP_EOL .'ID: ' . $newOrder->id);
            return $newOrder->id;
        } else {
            Alert::error(__('Saving error. Call Us.'));
            return false;
        }
    }

    public function step1FormDataInit(): Order
    {
        // Заход по роутам
//        if (!empty($this->params['to'])) {
//            $this->Session->delete('Order');
//            $this->request->data['Order'] = $this->Order->getDataFromRoute($this->params);
//        }
//        // Возврат по страницам
//        elseif ($this->Session->read('Order.id')) {
//            $this->request->data = $this->Order->getDataFor1Step($this->Session->read('Order.id'));
//        }
//        // Обратная поездка
//        elseif (!empty($returnOrder)) {
//            $this->request->data = $this->Order->getReturnOrderData($returnOrder);
//        }
//        // Такая же поездка
//        elseif (!empty($similarOrder)) {
//            $this->request->data = $this->Order->getSimilarOrderData($similarOrder);
//        }
//        // Quote
//        elseif (!empty($this->request->params['string_id'])) {
//            $this->loadModel('Quote');
//            $this->request->data['Order'] = $this->Quote->getOrderData($this->request->params['string_id']);
//        }
//        // Обычный заход
//        else {
            $order = new Order;

            $order->pickup_time = now()->addDay()->hour(12)->minute(0);

            return $order;
//        }

        // Для моб. исправляем дату
//        if (Configure::read('IS_MOBILE_DEVICE')) {
//            $this->request->data['Order']['date'] = dateToMySql($this->request->data['Order']['date']);
//        }
    }
}
