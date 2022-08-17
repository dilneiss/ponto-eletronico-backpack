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

Route::get('/home', 'HomeController@home');
Route::get('/', 'HomeController@index');

Route::get('/ponto', 'RecordsController@create');
Route::get('/historico', 'RecordsController@retrieve');

Route::get('/perfil', 'UsersController@profile')->name('profile.home');

Route::resource('record', 'RecordsController');

Route::group(['middleware' => ['web', 'auth']], function () {

    Route::post('profile/change-password', 'UsersController@changePassword')->name('profile.changePassword');

    Route::get('/colaboradores', 'UsersController@retrieve');

    Route::post('{id}/editarHistorico', 'RecordsController@editRecordsByUser')->name('edit.user.records');
    Route::get('{id}/editarHistorico', 'RecordsController@editRecordsByUser')->name('edit.user.records');

    Route::post('{id}/criarHistorico', 'RecordsController@createRecordsByAdmin')->name('create.user.records');
    Route::get('{id}/criarHistorico', 'RecordsController@createRecordsByAdmin')->name('create.user.records');


    Route::post('/update', 'RecordsController@update');

    Route::post('/create', 'RecordsController@createByAdmin');

    Route::get('/relatorios', 'RecordsController@reports');


});