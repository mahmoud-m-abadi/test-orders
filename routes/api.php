<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('menu', MenuController::class)->name('menu');
Route::post('order', OrderController::class)->name('order');
