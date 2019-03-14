<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('stats/record', 'PlayerController@record')->name('player.record');
Route::get('stats/gains/{name}', 'PlayerController@gains')->name('player.gains');
Route::get('stats/player/{name}', 'PlayerController@show')->name('player.show');
Route::get('stats/player/data-points/{name}', 'PlayerController@dataPoints')->name('player.datapoints');

Route::post('player/change-name', 'PlayerController@changeName')->name('player.change-name');

Route::get('leaderboard/skill/{name}', 'MetricsController@skillLeaderboard')->name('leaderboard.skills');
Route::get('leaderboard/achievements/{achievement}', 'MetricsController@achievementLeaderboard')->name('leaderboard.achievements');
