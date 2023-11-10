<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RealOrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [OrderController::class, 'step1'])->name('step1');
Route::post('/', [OrderController::class, 'step1Handler']);
Route::get('/step2', [OrderController::class, 'step2'])->name('step2');
Route::get('/step3', [OrderController::class, 'step3'])->name('step3');
Route::get('/login', [OrderController::class, 'login'])->name('login');
Route::get('/step4', [OrderController::class, 'step4'])->name('step4');
Route::get('/confirmation', [RealOrderController::class, 'confirmation'])->name('confirmation');

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/my-orders', [OrderController::class, 'my_orders'])->name('my_orders');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
