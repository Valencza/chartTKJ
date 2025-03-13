<?php

use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MidtransController;

Route::post('/midtrans/callback', [CheckoutController::class, 'callback']);
