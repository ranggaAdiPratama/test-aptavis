<?php

use App\Http\Controllers\ScoreController;
use App\Http\Controllers\ViewController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'classments'], function () {
    Route::get('/', [ViewController::class, 'classment']);
});
