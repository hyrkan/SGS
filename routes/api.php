<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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




Route::get('/seed_management', 'SeedController@seed_list');
Route::prefix('/seed_management')->group(function(){
    Route::post('/store', 'SeedController@store');
    Route::put('/{seed}', 'SeedController@update');
    Route::delete('/{seed}', 'SeedController@destroy');
});

Route::get('/seedbed_management', 'SeedbedController@seedbed_list');
Route::prefix('/seedbed_management')->group(function(){
    Route::post('/store', 'SeedbedController@store');
    Route::put('/{seedbed}', 'SeedbedController@update');
    Route::delete('/{seedbed}', 'SeedbedController@destroy');
});

Route::get('/plot_management', 'PlotController@plot_list');
Route::prefix('/plot_management')->group(function(){
    Route::post('/store', 'PlotController@store');
    Route::put('/{plot}', 'PlotController@update');
    Route::delete('/{plot}', 'PlotController@destroy');
});



Route::get('/staff_management', 'RegisterController@user_list');
Route::prefix('/staff_management')->group(function(){
    Route::post('/store', 'RegisterController@store');
    Route::get('/{staff}', 'RegisterController@update');
    Route::delete('/{staff}', 'RegisterController@destroy');
});


Route::get('/fetch_seeds', 'SeedSowingController@getSeed');
Route::get('/fetch_seedbed', 'SeedSowingController@getSeedbed');
Route::post('/seed_sowing','SeedSowingController@seed_sowing');
Route::get('/fetch_sowings','SeedSowingController@index');

