<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;
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
	$p = Redis::incr('p');
	return $p;
});

Route::get('/info', function() { phpinfo(); });

Route::get('/', function () {
    return view('auth.login');
});

/*
    php artisan clear-compiled
    composer dump-autoload
    php artisan optimize:clear
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

Route::group(['middleware' => ['accessLog', 'auth', 'verified']], function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('form', 'form')->name('form');

    Route::group(['prefix' => 'managementuser', 'as' => 'managementuser.'], function () {
        Route::get('profile', [UtilHelper::nameSpaceRouting(Management\ManagementUserController::class), 'profile'])->name('profile');

    });

    /*
    //management menu
    Route::get('managementmenu.index', 'Management\ManagementMenuController@index')->name('managementmenu.index');
    Route::post('managementmenu.store', 'Management\ManagementMenuController@store')->name('managementmenu.store');
    Route::post('managementmenu.update', 'Management\ManagementMenuController@update')->name('managementmenu.update');
    Route::get('/managementmenu/getDataMenusSecondByIdMasterMenus/{id}', 'Management\ManagementMenuController@getDataMenusSecondByIdMasterMenus')->name('getDataMenusSecondByIdMasterMenus');
    Route::get('/managementmenu/getDataMenu/{id}/{status}', 'Management\ManagementMenuController@getDataMenu')->name('getData.menu');
    Route::get('managementmenu/nonaktif/{id}/{condition}/{level}', 'Management\ManagementMenuController@updateStatus')->name('menu.nonaktif');
    Route::get('managementmenu/aktif/{id}/{condition}/{level}', 'Management\ManagementMenuController@updateStatus')->name('menu.aktif');

    //management user
    Route::get('managementuser.index', 'Management\ManagementUserController@index')->name('managementuser.index');
    Route::post('managementuser.store', 'Management\ManagementUserController@store')->name('managementuser.store');
    Route::get('managementuser/bind-user/{id}', 'Management\ManagementUserController@bind')->name('managementuser.bind');
    Route::put('managementuser.update', 'Management\ManagementUserController@update')->name('managementuser.update');
    Route::get('managementuser/nonaktif/{id}/{condition}', 'Management\ManagementUserController@updateStatus')->name('managementuser.nonaktif');
    Route::get('managementuser/aktif/{id}/{condition}', 'Management\ManagementUserController@updateStatus')->name('managementuser.aktif');
    Route::post('managementuser.update.password', 'Management\ManagementUserController@updPassword')->name('managementuser.update.password');
    Route::get('managementuser.search', 'Management\ManagementUserController@search')->name('managementuser.search');
    Route::get('managementuser/getDataStoreByCompanyId/{id}', 'Management\ManagementUserController@getDataStoreByCompanyId')->name('managementuser.storecompany');
    Route::post('managementuser.lockscreen', 'Management\ManagementUserController@lockscreen')->name('managementuser.lockscreen');
    //profile
    Route::get('managementuser.profile', 'Management\ManagementUserController@profile')->name('managementuser.profile');
    Route::post('managementuser.profile.password', 'Management\ManagementUserController@updatepasswordByUser')->name('managementuser.profile.password');

    //management role
    Route::get('managementrole.index', 'Management\ManagementRoleController@index')->name('managementrole.index');
    Route::get('managementrole.getRole', 'Management\ManagementRoleController@getDataAllRole')->name('managementrole.getRole');
    Route::get('managementrole.getRoleMenuByid/{id}', 'Management\ManagementRoleController@getDataAllRoleMenuById')->name('managementrole.getRoleMenuByid');
    Route::post('managementrole.create', 'Management\ManagementRoleController@create')->name('managementrole.create');
    Route::get('managementrole.edit/{id}', 'Management\ManagementRoleController@edit')->name('managementrole.edit');
    Route::get('managementrole.show/{id}', 'Management\ManagementRoleController@show')->name('managementrole.show');
    Route::post('managementrole.store', 'Management\ManagementRoleController@store')->name('managementrole.store');
    Route::put('managementrole.update', 'Management\ManagementRoleController@update')->name('managementrole.update');
    Route::put('managementrole.updateStatusRole', 'Management\ManagementRoleController@updateStatus')->name('managementrole.updateStatusRole');
    Route::post('managementrole.delInsAccess', 'Management\ManagementRoleController@delInsAccess')->name('managementrole.delInsAccess');
    */
});
