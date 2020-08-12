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

Route::get('/series', 'SeriesController@index')->name("series_home");
Route::get('/series/criar', 'SeriesController@create')->name("series_create");
Route::post('/series/criar', 'SeriesController@store')->name("series_store");
Route::delete('/series/remover/{id}', 'SeriesController@destroy')->name("series_delete");
