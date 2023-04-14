<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\Payment\Pay\PayController;

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

Route::get('user/payment/pay/purchase/{id}', [PayController::class, 'purchase']);
Route::post('user/payment/pay/complete/{id}', [PayController::class, 'complete']);
