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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => 'api','namespace'=>'Api'], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('user', 'AuthController@me');
});
Route::group(['middleware' => 'auth:api','namespace'=>'Api'], function ($router) {
  Route::get('countries', 'LocationController@countries');
  Route::get('countries/{id}/states', 'LocationController@states');
  Route::get('states/{id}/districts', 'LocationController@districts');
  Route::get('districts/{id}/cities', 'LocationController@cities');
  Route::get('cities/{id}/suppliers', 'LocationController@CitySuppliers');
});
