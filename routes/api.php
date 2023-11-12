<?php

use App\Api\RateController;
use App\Api\ZipCodeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/time-from-ohare', [ZipCodeController::class, 'timeFromOHare']);
Route::get('/zip-code-exists/{zip}', [ZipCodeController::class, 'exists'])->where('zip', '\d{5}');
Route::get('/address/autocomplete', [RateController::class, 'autocomplete']);
