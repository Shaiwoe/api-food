<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Article\ArticleController;
use App\Http\Controllers\User\Order\OrderController;
use App\Http\Controllers\User\Member\MemberController;
use App\Http\Controllers\User\Profile\ProfileController;



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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::apiResource('articles' , ArticleController::class);
Route::post('/auth/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth/check-otp', [AuthController::class, 'checkOtp']);
Route::post('/auth/resend-otp', [AuthController::class, 'resendOtp']);


Route::group(['middleware' => ['auth:sanctum']], function() {

    Route::post('/auth/me', [AuthController::class, 'me']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    Route::get('user/profile/show', [ProfileController::class, 'show']);
    Route::post('user/profile/create', [ProfileController::class, 'create']);

    Route::get('user/order/index', [OrderController::class, 'index']);
    Route::post('user/order/create', [OrderController::class, 'create']);

    Route::get('user/member/index', [MemberController::class, 'index']);
    Route::post('user/member/create', [MemberController::class, 'create']);
});
