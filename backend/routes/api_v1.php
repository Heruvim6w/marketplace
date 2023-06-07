<?php

use App\Http\Controllers\Api\V1\System\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\System\GoodsController;
use \App\Http\Controllers\Api\V1\Market\GoodsController as MarketGoodsController;

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

Route::prefix('system')
    ->name('system.')
    ->group(function () {
        Route::prefix('goods')
            ->name('goods.')
            ->group(function () {
                Route::get('/', [GoodsController::class, 'index'])->name('index');
                Route::post('/', [GoodsController::class, 'store'])->name('store');
                Route::patch('/', [GoodsController::class, 'update'])->name('update');
                Route::post('/removeFromSale', [GoodsController::class, 'removeFromSale'])->name('removeFromSale');
            });
        Route::prefix('orders')
            ->name('orders.')
            ->group(function () {
                Route::get('/{external_id}', [OrderController::class, 'getOrder'])->name('getOrder');
            });
    });

Route::prefix('market')
    ->name('market.')
    ->group(function () {
        Route::prefix('goods')
            ->name('goods.')
            ->group(function () {
                Route::post('/sold', [MarketGoodsController::class, 'sold'])->name('sold');
            });
    });
