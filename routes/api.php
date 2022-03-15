<?php

use App\Http\Controllers\FoodController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('menu', FoodController::class)->name('menu');
Route::post('order', OrderController::class)->name('order');
