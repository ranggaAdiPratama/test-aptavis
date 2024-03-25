<?php

use App\Http\Controllers\ScoreController;
use App\Http\Controllers\ViewController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'scores'], function () {
    Route::get('/single', [ViewController::class, 'scoreSingle']);
    Route::get('/multiple', [ViewController::class, 'scoreMulti']);
    Route::post('/', [ScoreController::class, 'store']);
});
