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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource('series', SeriesController::class);

Route::post('series/create', 'SeriesController@store');

Route::post('series/{id}', 'SeriesController@destroy');

Route::get('series/{id}/temporadas', 'TemporadasController@index');

Route::post('/series/{id}/editaNome', 'SeriesController@editaNome');

Route::get('/temporada/{temporada}/episodios', 'EpisodiosController@index');

Route::post('/temporada/{temporada}/episodios/assistir', 'EpisodiosController@assistir');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
