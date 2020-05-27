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
	if(!Auth::check()) {
		return view('welcome');
	} else {
		return redirect('/home');
	}
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/dpl', 'DPLController@index');
Route::post('/dpl', 'DPLController@generate');

Route::get('/button-updates', 'ButtonUpdateController@index');
Route::post('/button-updates', 'ButtonUpdateController@execute');

Route::group(['prefix' => 'locations'], function () {

	Route::get('/', 'LocationController@index')
		->middleware('can:list-locations')
		->name('locations.index');

	Route::get('/create', 'LocationController@create')
		->middleware('can:create-locations')
		->name('locations.create');

	Route::post('/', 'LocationController@store')
		->middleware('can:create-locations')
		->name('locations.store');

	Route::get('/{location}', 'LocationController@show')
		->middleware('can:view-locations')
		->name('locations.show');

	Route::get('/{location}/edit', 'LocationController@edit')
		->middleware('can:edit-locations')
		->name('locations.edit');

	Route::put('/{location}', 'LocationController@update')
		->middleware('can:edit-locations')
		->name('locations.update');

	Route::delete('/{location}', 'LocationController@destroy')
		->middleware('can:destroy-locations')
		->name('locations.destroy');

	Route::get('/{location}/databases/create', 'LocationDatabaseController@create')
		->middleware('can:create-databases')
		->name('locations.databases.create');

	Route::post('/{location}/databases', 'LocationDatabaseController@store')
		->middleware('can:create-databases')
		->name('locations.databases.store');

	Route::get('/{location}/databases/{database}/edit', 'LocationDatabaseController@edit')
		->middleware('can:edit-databases')
		->name('locations.databases.edit');

	Route::put('/{location}/databases/{database}', 'LocationDatabaseController@update')
		->middleware('can:edit-databases')
		->name('locations.databases.update');

	Route::delete('/{location}/databases/{database}', 'LocationDatabaseController@destroy')
		->middleware('can:destroy-databases')
		->name('locations.databases.destroy');

});