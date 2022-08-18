<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can panel web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\RecordsController;
use App\Http\Controllers\UsersController;

Auth::routes();

Route::group(['middleware' => ['web', 'auth']], function () {

    Route::get('/home', 'HomeController@home');
    Route::get('/', 'HomeController@index');

    Route::get('/profile', 'UsersController@profile')->name('profile.home');
    Route::post('profile/change-password', 'UsersController@changePassword')->name('profile.changePassword');

    Route::resource('point', RecordsController::class);

    Route::resource('users', UsersController::class);

    Route::get('/reports', 'RecordsController@reports');


});