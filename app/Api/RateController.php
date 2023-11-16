<?php

namespace App\Api;

use App\Http\Controllers\Controller;
use App\Services\RateService;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final  class RateController extends Controller
{
    /**
     * @throws \Throwable
     */
    public function autocomplete(Request $request): array
    {
        $term = $request->input('term');

        throw_if(empty($term), new NotFoundHttpException());

        return RateService::getAutocompleteCities($term, 8);
    }
}
