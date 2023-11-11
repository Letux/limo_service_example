<?php

namespace App\Http\Controllers;

use App\Models\ZipCode;
use App\Services\AddressService;
use Illuminate\HTTP\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class ZipCodeController extends Controller
{
    /**
     * @throws \Throwable
     */
    public function timeFromOHare(Request $request)
    {
        throw_if(empty($request->query('address')), new NotFoundHttpException());

        $zip = AddressService::getZip($request->query('address'));

        throw_if(empty($zip), new NotFoundHttpException());

        return ZipCode::getHoursFormORD($zip);
    }

    /**
     * @throws \Throwable
     */
    public function exists(Request $request, string $zip)
    {
        return ZipCode::isExisted($zip) ? '1': '0';
    }
}
