<?php

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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();
Route::get('/', 'HomeController@index');
Route::post('dropzone/store','HomeController@store');
Route::post('dropzone/store_media','HomeController@storeMedia');

Route::prefix('users')->group(function () {
    Route::get('/', 'UsersController@index')->name('users.index');
    Route::get('create', 'UsersController@create')->name('users.create');
    Route::post('create', 'UsersController@store')->name('users.store');
    Route::get('edit/{id}', 'UsersController@edit')->name('users.edit');
    Route::post('edit/{id}', 'UsersController@update')->name('users.update');
    Route::post('delete', 'UsersController@destroy')->name('users.destroy');
});

