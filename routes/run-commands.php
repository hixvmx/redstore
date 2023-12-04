<?php
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

Route::prefix('/run/command')->group(function() {
    // Route::get('/composer-install', function() {
    //     Artisan::call('composer:install');
    //     return 'Running composer install.';
    // });
    Route::get('/composer-install', function () {
        $process = new Process(['composer', 'install']);
        
        try {
            $process->mustRun();
            return 'Composer install completed successfully.';
        } catch (ProcessFailedException $exception) {
            return 'Composer install failed: ' . $exception->getMessage();
        }
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