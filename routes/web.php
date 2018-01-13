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

Route::get('/catalog','TitlesController@index')->name('catalog');

Route::get('/inputs', function () {
    return view('layouts.components.input');
});

Auth::routes();

Route::get('/titles', 'TitlesController@index')->name('catalog');
Route::resource('titles/movies', 'MoviesController')->name("edit","edit")->name('show','title');
Route::resource('titles/series', 'SeriesController')->name("edit","edit")->name('show','title');
Route::get('titles/series/{series_id}/seasons', 'SeasonsController@index');
Route::get('titles/series/{series_id}/seasons/{season_number}', 'SeasonsController@show');
Route::delete('titles/series/{series_id}/seasons/{season_number}', 'SeasonsController@destroy');
Route::get('titles/series/{series_id}/seasons/{season_number}/episodes', 'EpisodesController@index');
Route::get('titles/series/{series_id}/seasons/{season_number}/episodes/{episode_number}', 'EpisodesController@show');
Route::get('titles/series/{series_id}/seasons/{season_number}/episodes/{episode_number}/edit', 'EpisodesController@edit')->name('edit');
Route::put('titles/series/{series_id}/seasons/{season_number}/episodes/{episode_number}', 'EpisodesController@update');
Route::delete('titles/series/{series_id}/seasons/{season_number}/episodes/{episode_number}', 'EpisodesController@destroy');

Route::resource('people', 'PeopleController');
Route::resource('reviews', 'ReviewsController');
Route::resource('comments', 'CommentsController');
Route::resource('users', 'UsersController');