<?php

use App\Http\Controllers\ClubController;
use App\Http\Controllers\ViewController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'clubs'], function () {
    Route::get('/', [ViewController::class, 'club']);
    Route::get('/{id}', [ClubController::class, 'show']);
    Route::post('/', [ClubController::class, 'store']);
});
