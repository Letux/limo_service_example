<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStep1Request;
use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;

final class OrderController extends Controller
{
    public function step1(OrderService $orderService)
    {
        [$minDate, $minTime, $minDay] = $orderService->getStep1TimeSettings();

        [$maxPassengers, $airports, $holidays, $minCharterHours, $to, $charterMinutes] = $orderService->step1InitVars();

        $order = $orderService->step1FormDataInit();

        return view('order.step1', compact('minDate', 'minTime', 'minDay', 'maxPassengers', 'airports', 'holidays', 'minCharterHours', 'to', 'charterMinutes', 'order'));
    }

    /**
     * @throws \Throwable
     */
    public function step1Handler(OrderStep1Request $request, OrderService $orderService): RedirectResponse
    {
        $orderId = $orderService->step1Handler(
            $request->validated(),
            $request->cookie('UserCameFrom'),
            $request->getHttpHost()
        );

        if ($orderId === false) {
            return redirect()->route('step1')->withInput();
        }

        return redirect()->route('step2', ['id' => $orderId]);
    }
}
