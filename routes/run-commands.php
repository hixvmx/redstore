<?php
use Illuminate\Support\Facades\Artisan;

Route::prefix('/run/command')->group(function() {
    Route::get('/composer-install', function() {
        Artisan::call('composer:install');
        return 'Running composer install.';
    });
    
    Route::get('/migrate', function() {
        Artisan::call('migrate');
        return 'Migrating database.';
    });

    Route::get('/seed', function() {
        Artisan::call('db:seed --class=CountrySeeder');
        Artisan::call('db:seed --class=CategorySeeder');
        Artisan::call('db:seed --class=CurrencySeeder');
        return 'Seeding database.';
    });
});