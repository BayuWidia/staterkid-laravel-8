<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

/*
php artisan clear-compiled
composer dump-autoload
php artisan optimize
*/

Route::get('/clear-cache', function() {
	Artisan::call('cache:clear');
	Artisan::call('view:clear');
	Artisan::call('route:clear');
	Artisan::call('clear-compiled');
	Artisan::call('config:clear');
    Artisan::call('config:cache');
    return view('errors.clear');
})->name('clear-cache');

Route::group(['middleware' => ['accessLog']], function () {
    Route::middleware('auth', 'verified')->group(function () {
        Route::view('dashboard', 'dashboard')->name('dashboard');
        Route::view('form', 'form')->name('form');
        Route::view('profile', 'profile')->name('profile');

        Route::get('/test-a', 'Management\ManagementMenuController@index')->name('test-a');
    });
});
