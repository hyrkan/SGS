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



Route::get('/product_list', 'ProductInventoryController@product_list');
Route::get('/seed_management', 'SeedController@seed_list');
Route::post('/add_seed_quantity', 'SeedController@add_seed_quantity');
Route::post('/add_fertilizer_quantity', 'FertilizerController@add_fertilizer_quantity');
Route::post('/add_pesticide_quantity', 'PesticideController@add_pesticide_quantity');
Route::get('/task_list', 'TaskController@fetch_task');
Route::post('/task', 'TaskController@store');

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

Route::get('/fertilizer_list', 'FertilizerController@fertilizer_list');
Route::prefix('/fertilizer')->group(function(){
    Route::post('/store', 'FertilizerController@store');
    Route::put('/{fertilizer}', 'FertilizerController@update');
    Route::delete('/{fertilizer}', 'FertilizerController@destroy');
});

Route::get('/pesticide_list', 'PesticideController@pesticide_list');

Route::prefix('/pesticide')->group(function(){
    Route::post('/store', 'PesticideController@store');
    Route::put('/{pesticide}', 'PesticideController@update');
Route::delete('/{pesticide}', 'PesticideController@destroy');
});


Route::get('/fetch_seeds', 'SeedSowingController@getSeed');
Route::get('/fetch_seedbed', 'SeedSowingController@getSeedbed');
Route::post('/seed_sowing','SeedSowingController@seed_sowing');
Route::get('/fetch_sowings','SeedSowingController@index');
Route::get('/fetch_plot', 'SeedSowingController@getPlot');
Route::post('/seed_plot', 'SeedPlotController@store');
Route::post('/notify_transfer', 'SeedPlotController@notify');


Route::get('/for_transfer_today', 'SeedSowingController@today');
Route::get('/for_harvest_today','SeedPlotController@today');


Route::get('/fetch_seedPlots', 'SeedPlotController@index');

