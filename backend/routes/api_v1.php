<?php

use App\Http\Controllers\Api\V1\System\OrderController;
use App\Http\Controllers\Api\V1\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\System\GoodsController;
use App\Http\Controllers\Api\V1\Market\GoodsController as MarketGoodsController;

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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::prefix('system')
    ->name('system.')
    ->middleware('jwt.auth')
    ->group(function () {
        Route::prefix('goods')
            ->name('goods.')
            ->group(function () {
                Route::get('/', [GoodsController::class, 'index'])->name('index');
                Route::post('/', [GoodsController::class, 'store'])->name('store');
                Route::patch('/', [GoodsController::class, 'update'])->name('update');
                Route::post('/removeFromSale', [GoodsController::class, 'removeFromSale'])->name('removeFromSale');
                Route::post('/sold', [GoodsController::class, 'sold'])->name('sold');
            });
        Route::prefix('orders')
            ->name('orders.')
            ->group(function () {
                Route::get('/{external_id}', [OrderController::class, 'getOrder'])->name('getOrder');
            });
    });

Route::prefix('market')
    ->name('market.')
    ->middleware('jwt.auth')
    ->group(function () {
        Route::prefix('goods')
            ->name('goods.')
            ->group(function () {
                Route::post('/sold', [MarketGoodsController::class, 'sold'])->name('sold');
            });
    });
