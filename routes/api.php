<?php

use App\Http\Controllers\V1\CustomerController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'customer.', 'prefix' => 'v1', 'middleware' => ["throttle:20,1"]], function () {
    Route::get('/customers', [CustomerController::class, 'index'])->name('index');
});
