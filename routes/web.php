<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\StockController::class,'index']);
Route::post('goods/create', [\App\Http\Controllers\StockController::class,'createGood'])->name('goods.create');

Route::post('goods/purchase', [\App\Http\Controllers\StockController::class,'purchase'])->name('goods.purchase');

Route::post('goods/return', [\App\Http\Controllers\StockController::class,'return'])->name('goods.return');

Route::post('goods/sale', [\App\Http\Controllers\StockController::class,'sale'])->name('goods.sale');
