<?php

use Illuminate\Http\Request;

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

Route::group(['middleware' => 'auth:api'], function() {
    Route::apiResource('artists', 'ArtistController');
    Route::put('artists/{artist}', 'ArtistController@update');
    Route::delete('artists/{artist}', 'ArtistController@destroy');
    
    Route::apiResource('concerts', 'ConcertController');
    Route::put('concerts/{concert}', 'ConcertController@update');
    Route::delete('concerts/{concert}', 'ConcertController@destroy');
    
    Route::apiResource('concertTypes', 'ConcertTypeController');
    
    Route::apiResource('venues', 'VenueController');
    Route::put('venues/{venue}', 'VenueController@update');
    Route::delete('venues/{venue}', 'VenueController@destroy');

    Route::post('logout', 'Auth\LoginController@logout');
});

Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');
