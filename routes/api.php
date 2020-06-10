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

Route::prefix('catalog/{database}')->group(function () {

	Route::get('areas', 'CenterEdge\AreaController@index');
	Route::get('areas/arrivals', 'CenterEdge\AreaController@indexWithArrivals');
	Route::get('areas/{area}', 'CenterEdge\AreaController@show');
	Route::get('areas/{area}/arrivals', 'CenterEdge\AreaController@showWithArrivals');

	Route::get('arrivals', 'CenterEdge\ArrivalController@index');
	Route::get('arrivals/areas', 'CenterEdge\ArrivalController@indexWithArrivals');
	Route::get('arrivals/{arrival}', 'CenterEdge\ArrivalController@show');
	Route::get('arrivals/{arrival}/areas', 'CenterEdge\ArrivalController@showWithAreas');

});