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

Auth::routes();

Route::group(['middleware' => ['web', 'auth']], function () {

    Route::get('/home', 'HomeController@home');
    Route::get('/', 'HomeController@index');

    Route::get('/perfil', 'UsersController@profile')->name('profile.home');

    Route::resource('point', 'RecordsController');

    Route::post('profile/change-password', 'UsersController@changePassword')->name('profile.changePassword');
    Route::post('{id}/save-point', 'RecordsController@createRecordsByAdmin')->name('create.user.records');


    Route::resource('users', \App\Http\Controllers\UsersController::class);
    Route::get('/relatorios', 'RecordsController@reports');


});