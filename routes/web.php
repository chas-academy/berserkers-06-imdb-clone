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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/catalog', function () {
    return view('catalog');
})->name('catalog');

Route::get('/inputs', function () {
    return view('layouts.components.input');
});

Route::get('/gallery', function () {
    return view('layouts.components.gallery');
})->name('gallery');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/titles', 'TitlesController@index');
Route::resource('titles/movies', 'MoviesController')->name('show','title');
Route::resource('titles/series', 'SeriesController');
Route::get('titles/series/{series_id}/seasons', 'SeasonsController@index');
Route::get('titles/series/{series_id}/seasons/{season_number}', 'SeasonsController@show');
Route::get('titles/series/{series_id}/seasons/{season_number}/episodes', 'EpisodesController@index');
Route::get('titles/series/{series_id}/seasons/{season_number}/episodes/{episode_number}', 'EpisodesController@show');

Route::resource('people', 'PeopleController');
Route::resource('reviews', 'ReviewsController');
Route::resource('comments', 'CommentsController');
Route::resource('users', 'UsersController');