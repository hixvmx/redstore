<?php

use App\Http\Controllers\DashboardController;


Route::prefix('/dashboard')->middleware(['auth','admin'])->group(function() {
    Route::controller(DashboardController::class)->group(function() {
        Route::get('/', 'show_home');
        Route::get('/accounts', 'show_accounts');
        Route::get('/ads', 'show_ads');
        Route::get('/categories', 'show_categories');
        Route::get('/countries', 'show_countries');
    });
});