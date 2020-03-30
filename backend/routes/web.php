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
Route::get('/privacy-policy', function () {
    return view('privacy');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/test', 'HomeController@test');
Route::group(['middleware' => ['auth','can:isAdmin']], function ($router) {
    Route::resource('symptoms', 'SymptomController');
    Route::resource('posts', 'PostController');
    Route::resource('precautions', 'PrecautionController');
    Route::resource('countries', 'CountryController');
    Route::resource('states', 'StateController');
    Route::get('/country/states','StateController@getStatesByCountry');
    Route::resource('districts', 'DistrictController');
    Route::get('/country/state/districts','DistrictController@getDistrictsByState');
    Route::resource('subdistricts', 'SubdistrictController');
    Route::get('/country/state/district/subdistricts','SubdistrictController@getSubdistrictByDistrict');
    Route::resource('cities', 'CityController');
    Route::get('/country/state/district/subdistrict/cities','CityController@getCitiesBySubdistrict');
    Route::resource('suppliers', 'SupplierController');
    Route::resource('lostpatients', 'LostPatientController');
    Route::resource('helplines', 'HelplineController');
    Route::resource('patients', 'PatientController');
    Route::resource('users', 'UserController');
    Route::resource('feedbacks', 'FeedbackController');
});
