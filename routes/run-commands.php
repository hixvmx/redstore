<?php
use Illuminate\Support\Facades\Artisan;

Route::prefix('/run/command')->group(function() {
    Route::get('/migrate', function() {
        Artisan::call('migrate');
        return 'Migrating database.';
    });

    // Clear application cache:
    Route::get('/seeder', function() {
        Artisan::call('db:seed --class=CountrySeeder');
        Artisan::call('db:seed --class=CategorySeeder');
        Artisan::call('db:seed --class=CurrencySeeder');
        return 'Seeding database.';
    });
});