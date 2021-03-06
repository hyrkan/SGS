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
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/staff_management', 'RegisterController');
Route::get('/seed_management', 'SeedController@index');
Route::get('/seedbed_management', 'SeedbedController@index');
Route::get('/plot_management', 'PlotController@index');
Route::get('/fertilizer', 'FertilizerController@index');
Route::get('/pesticide', 'PesticideController@index');
Route::get('/task/{id}','TaskController@show');
Route::get('/product_inventory','ProductInventoryController@index');


Route::get('/seed_sowing','SeedSowingController@cultivation');
Route::get('/seed_plot','SeedPlotController@cultivation');



Route::get( '/{any}', function(){
    return view( 'home' );
} )->where('any', '.*');