<?php

use App\Http\Controllers\IncomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('test');
});

Route::get('/sales', [SaleController::class, 'getData'])->name('sales');
Route::get('/orders', [OrderController::class, 'getData'])->name('orders');
Route::get('/stocks', [StockController::class, 'getData'])->name('stocks');
Route::get('/incomes', [IncomeController::class, 'getData'])->name('incomes');
