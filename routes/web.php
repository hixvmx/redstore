<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    UserController,
    HomeController,
    AdController,
    ProfileController,
    AccountController,
    SearchController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// authentication routes
Route::controller(UserController::class)->group(function() {
    Route::middleware('guest')->group(function() {
        Route::get('/register', 'ShowRegisterPage');
        Route::post('/register', 'SaveNewUser');
        Route::get('/login', 'ShowLoginPage');
        Route::post('/login', 'login');
    });
    Route::get('/logout', 'logout')->middleware('auth');
});


Route::controller(HomeController::class)->group(function() {
    Route::get('/', 'ShowHomePage');
});


Route::controller(AdController::class)->group(function() {
    Route::get('/ad/{slug}', 'ShowAdPage');
    Route::get('/new-ad', 'ShowNewAdPage')->middleware('auth');
    Route::get('/edit-ad/{slug}', 'ShowEditAdPage')->middleware('auth');
    Route::post('/update-ad', 'updateAd')->middleware('auth');
    Route::get('/delete-ad/{slug}', 'deleteAd')->middleware('auth');
    Route::post('/save-new-ad', 'saveNewAd')->middleware('auth');
});


Route::controller(ProfileController::class)->group(function() {
    Route::get('/user/{username}', 'ShowUserPage');
});


Route::controller(AccountController::class)->group(function() {
    Route::middleware('auth')->group(function() {
        Route::get('/account/ads', 'ShowAdsPage');
        Route::get('/account/favorites', 'ShowFavoritesPage');
        Route::get('/account/settings', 'ShowSettingsPage');
        Route::post('/account/update-settings', 'updateSettings');
        Route::get('/account/contact-informations', 'ShowContactInformationsPage');
        Route::post('/account/update-contact-informations', 'updateContactInformations');
        Route::get('/account/change-password', 'ShowChangePasswordPage');
        Route::post('/account/update-password', 'updatePassword');
    });
});


Route::controller(SearchController::class)->group(function() {
    Route::get('/search', 'ShowSearchPage');
});
