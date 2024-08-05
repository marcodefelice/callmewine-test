<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CryptoController;

Route::get('/cryptos', [CryptoController::class, 'index']);

