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
Route::middleware('auth')->resource('symptoms', 'SymptomController');
Route::middleware('auth')->resource('posts', 'PostController');
Route::middleware('auth')->resource('precautions', 'PrecautionController');
Route::middleware('auth')->resource('countries', 'CountryController');
Route::middleware('auth')->resource('states', 'StateController');
Route::middleware('auth')->get('/country/states','StateController@getStatesByCountry');
Route::middleware('auth')->resource('districts', 'DistrictController');
Route::middleware('auth')->get('/country/state/districts','DistrictController@getDistrictsByState');
Route::middleware('auth')->resource('cities', 'CityController');
