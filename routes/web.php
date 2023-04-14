<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\Payment\Zibal\ZibalController;

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

Route::get('user/payment/zibal/purchase/{id}', [ZibalController::class, 'purchase']);
Route::get('user/payment/zibal/complete/{id}', [ZibalController::class, 'complete']);
