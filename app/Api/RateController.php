<?php

namespace App\Api;

use App\Http\Controllers\Controller;
use App\Models\Rate;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final  class RateController extends Controller
{
    /**
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function autocomplete(Request $request): array
    {
        $term = $request->input('term');

        throw_if(empty($term), new NotFoundHttpException());

        return Rate::getAutocompleteCities($term, 8);
    }
}
