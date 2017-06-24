<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

// Route::resource('brands', 'CarBrandsController');
Route::get('/brands', 'CarBrandsController@index');
Route::get('/brands/create', 'CarBrandsController@create')->middleware('auth');
Route::post('/brands', 'CarBrandsController@store')->middleware('auth');
Route::get('/brands/{name}', 'CarBrandsController@show');
Route::get('/brands/{name}/edit', 'CarBrandsController@edit')->middleware('auth');
Route::put('/brands/{name}', 'CarBrandsController@update')->middleware('auth');
Route::delete('/brands/{name}', 'CarBrandsController@destroy')->middleware('auth');


// Route::resource('engines', 'CarEnginesController');
Route::get('/engines', 'CarEnginesController@index');
Route::get('/engines/create', 'CarEnginesController@create')->middleware('auth');
Route::post('/engines', 'CarEnginesController@store')->middleware('auth');
Route::get('/engines/{name}', 'CarEnginesController@show');
Route::get('/engines/{name}/edit', 'CarEnginesController@edit')->middleware('auth');
Route::put('/engines/{name}', 'CarEnginesController@update')->middleware('auth');
Route::delete('/engines/{name}', 'CarEnginesController@destroy')->middleware('auth');

// Route::resource('models', 'CarModelsBrandController');
Route::get('/models', 'CarModelsBrandController@index');
Route::get('/models/create', 'CarModelsBrandController@create')->middleware('auth');
Route::post('/models', 'CarModelsBrandController@store')->middleware('auth');
Route::get('/models/{name}', 'CarModelsBrandController@show');
Route::get('/models/{name}/edit', 'CarModelsBrandController@edit')->middleware('auth');
Route::put('/models/{name}', 'CarModelsBrandController@update')->middleware('auth');
Route::delete('/models/{name}', 'CarModelsBrandController@destroy')->middleware('auth');

// Route::resource('colors', 'CarColorsController');
Route::get('/colors', 'CarColorsController@index');
Route::get('/colors/create', 'CarColorsController@create')->middleware('auth');
Route::post('/colors', 'CarColorsController@store')->middleware('auth');
Route::get('/colors/{name}', 'CarColorsController@show');
Route::get('/colors/{name}/edit', 'CarColorsController@edit')->middleware('auth');
Route::put('/colors/{name}', 'CarColorsController@update')->middleware('auth');
Route::delete('/colors/{name}', 'CarColorsController@destroy')->middleware('auth');

// Route::resource('cars', 'CarsController');
Route::get('/cars', 'CarsController@index');

Route::get('/cars/search', 'CarsController@searchForm');

Route::post('/cars/search', 'CarsController@searchResult');
Route::get('/cars/create', 'CarsController@create')->middleware('auth');
Route::post('/cars', 'CarsController@store')->middleware('auth');
Route::get('/cars/{name}', 'CarsController@show');
Route::get('/cars/{name}/edit', 'CarsController@edit')->middleware('auth');
Route::put('/cars/{name}', 'CarsController@update')->middleware('auth');
Route::delete('/cars/{name}', 'CarsController@destroy')->middleware('auth');