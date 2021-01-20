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

Route::get('/clear-cache', function() {
	Artisan::call('cache:clear');
	Artisan::call('view:clear');
	Artisan::call('route:clear');
	Artisan::call('clear-compiled');
	Artisan::call('config:clear');
	Artisan::call('config:cache');
})->name('clear-cache');

Route::middleware('auth', 'verified')->group(function () {
	Route::view('dashboard', 'dashboard')->name('dashboard');
  Route::view('form', 'form')->name('form');
	Route::view('profile', 'profile')->name('profile');
});
