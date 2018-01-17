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

Route::get('/userpage','UsersController@index')->name('userpage');

Route::get('/catalog','TitlesController@index')->name('catalog');

Auth::routes();

Route::get('/titles', 'TitlesController@index')->name('catalog');

Route::group(['middleware' => ['auth']], function () {
    Route::delete('titles/series/{series}','SeriesController@destory' );
    Route::delete('titles/movies/{movie}', 'MoviesController@destroy');
    Route::put('titles/series/{series}','SeriesController@update' );
    Route::put('titles/movies/{movie}', 'MoviesController@update');
    Route::get('titles/series/{series}/edit','SeriesController@edit' )->name("edit");
    Route::get('titles/movies/{movie}/edit', 'MoviesController@edit')->name("edit");
    Route::delete('titles/series/{series_id}/seasons/{season_number}', 'SeasonsController@destroy');
    Route::get('titles/series/{series_id}/seasons/{season_number}/episodes/{episode_number}/edit', 'EpisodesController@edit')->name('edit');
    Route::put('titles/series/{series_id}/seasons/{season_number}/episodes/{episode_number}', 'EpisodesController@update');
    Route::delete('titles/series/{series_id}/seasons/{season_number}/episodes/{episode_number}', 'EpisodesController@destroy');
    Route::resource('lists', 'ListsController')->name('index', 'lists');
    Route::put('titles/{title}/rate', 'TitlesController@rate');
});

Route::get('titles/series/{series}','SeriesController@show' )->name("title");
Route::get('titles/movies/{movie}', 'MoviesController@show')->name("title");
Route::get('titles/series/{series_id}/seasons', 'SeasonsController@index');
Route::get('titles/series/{series_id}/seasons/{season_number}', 'SeasonsController@show');
Route::get('titles/series/{series_id}/seasons/{season_number}/episodes', 'EpisodesController@index');
Route::get('titles/series/{series_id}/seasons/{season_number}/episodes/{episode_number}', 'EpisodesController@show')->name('title');


Route::resource('people', 'PeopleController');
Route::resource('reviews', 'ReviewsController');
Route::resource('comments', 'CommentsController');
Route::resource('users', 'UsersController');

