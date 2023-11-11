<?php

namespace App\Http\Controllers;

use App\Models\ZipCode;
use App\Services\AddressService;
use Illuminate\HTTP\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class ZipCodeController extends Controller
{
    public function timeFromOHare(Request $request)
    {
        if (empty($request->query('address'))) {
            throw new NotFoundHttpException();
        }

        $zip = AddressService::getZip($request->query('address'));
        if (empty($zip)) {
            throw new NotFoundHttpException();
        }

        return ZipCode::getHoursFormORD($zip);
    }
}
