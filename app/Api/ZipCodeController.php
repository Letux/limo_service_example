<?php

namespace App\Api;

use App\Http\Controllers\Controller;
use App\Models\ZipCode;
use App\Services\AddressService;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class ZipCodeController extends Controller
{
    /**
     * @throws \Throwable
     */
    public function timeFromOHare(Request $request): array
    {
        $address = $request->input('address');

        throw_if(empty($address), new NotFoundHttpException());

        $zip = AddressService::getZip($address);

        throw_if(empty($zip), new NotFoundHttpException());

        return ['result' => ZipCode::getHoursFormORD($zip)];
    }

    /**
     * @throws \Throwable
     */
    public function exists(Request $request, string $zip): array
    {
        return ZipCode::isExisted($zip) ? ['result' => '1']: ['result' => '0'];
    }

}
