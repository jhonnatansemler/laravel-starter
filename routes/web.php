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

use Illuminate\Support\Facades\Auth;

Route::get('/series', 'SeriesController@index')
    ->name("series_home");
Route::get('/series/criar', 'SeriesController@create')
    ->name("series_create")
    ->middleware("authenticator");
Route::post('/series/criar', 'SeriesController@store')
    ->name("series_store")
    ->middleware("authenticator");
Route::post('/series/{id}/editName', 'SeriesController@editName')
    ->middleware("authenticator");
Route::delete('/series/remover/{id}', 'SeriesController@destroy')
    ->name("series_delete")
    ->middleware("authenticator");


Route::get('/series/{serieID}/temporadas', 'SeasonsController@index');

Route::get('/temporadas/{temporada}/episodios', 'EpisodesController@index');
Route::post('/temporadas/{temporada}/episodios/assistir', 'EpisodesController@assistir')
    ->middleware("authenticator");

Auth::routes();

Route::get('/home', 'HomeController@index')
    ->name('home');

Route::get('/authentication', 'AuthenticationController@index')
    ->name('authentication');
Route::post('/authentication', 'AuthenticationController@auth')
    ->name('authentication');


Route::get('/registration', 'RegistrationController@create')
    ->name('registration');
Route::post('/registration', 'RegistrationController@store')
    ->name('registration');

Route::get('/exit', function(){
    Auth::logout();
    return redirect('/authentication');
});
