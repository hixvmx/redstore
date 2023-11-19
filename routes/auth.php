<?php

use App\Http\Controllers\UserController;


Route::controller(UserController::class)->group(function() {
    Route::middleware('guest')->group(function() {
        Route::get('/register', 'ShowRegisterPage');
        Route::post('/register', 'SaveNewUser');
        Route::get('/login', 'ShowLoginPage');
        Route::post('/login', 'login');
    });
    Route::get('/logout', 'logout')->middleware('auth');
});