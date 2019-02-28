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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/stats/record', 'PlayerController@record')->name('player.record');
Route::get('/stats/gains/{name}', 'PlayerController@gains')->name('player.gains');
Route::get('/stats/player/{name}', 'PlayerController@show')->name('player.show');
