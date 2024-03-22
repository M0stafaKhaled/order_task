<?php

use App\Http\Controllers\AuthApiController;
use App\Http\Controllers\ProductApiController;
use App\Http\Controllers\RegisterApiController;
use App\Http\Controllers\UserApiController;
use App\Http\Requests\Api\AuthApiRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:api'], function () {

    // Auth
    Route::group(['prefix' => 'auth'], function () {
        Route::post('logout', [AuthApiController::class, 'logout']);
    });

    // User
    Route::group(['prefix' => 'user'], function () {
        Route::get('profile', [UserApiController::class, 'profile']);
    });

    // Products
    Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
        Route::get('/', [ProductApiController::class, 'index'])->name('index');
        Route::get('/{product}', [ProductApiController::class, 'show'])->name('show');
        Route::post('/', [ProductApiController::class, 'store'])->name('store');
        Route::put('/{product}', [ProductApiController::class, 'update'])->name('update');
        Route::delete('/{product}', [ProductApiController::class, 'destroy'])->name('destroy');
    });



});

Route::post('register', RegisterApiController::class);
Route::post('login', [AuthApiController::class, 'login']);
