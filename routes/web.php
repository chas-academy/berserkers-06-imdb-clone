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

Route::get('/catalog', 'TitlesController@index')->name('catalog');


Auth::routes();

Route::group(['namespace' => 'Auth'], function () {

    Route::post('/login/checkifdeactivated', 'LoginController@checkIfDeactivated');
});

Route::get('/titles', 'TitlesController@index')->name('catalog');

Route::group(['middleware' => ['auth']], function () {
    /** Admin */
    Route::get('admin/users', 'AdminUserController@index')->name('edit');
    Route::post('admin/users', 'AdminUserController@store');
    Route::put('admin/users/{user}', 'AdminUserController@update');

    Route::get('admin/addtitle', 'TitlesController@create')->name('edit');
    Route::post('admin/addtitle/store', 'TitlesController@store');

    Route::get('titles/create', 'TitlesController@create')->name('edit');
    Route::post('titles/store', 'TitlesController@store');
    
    Route::get('titles/movies/{movie}/edit', 'MoviesController@edit')->name("edit");
    Route::put('titles/movies/{movie}', 'MoviesController@update');
    Route::delete('titles/movies/{movie}', 'MoviesController@destroy');

    Route::get('titles/series/{series}/edit', 'SeriesController@edit')->name("edit");
    Route::put('titles/series/{series}', 'SeriesController@update');
    Route::delete('titles/series/{series}', 'SeriesController@destory');

    Route::delete('titles/series/{series_id}/seasons/{season_number}', 'SeasonsController@destroy');
    Route::get('titles/series/{series_id}/seasons/{season_number}/episodes/{episode_number}/edit', 'EpisodesController@edit')->name('edit');
    Route::put('titles/series/{series_id}/seasons/{season_number}/episodes/{episode_number}', 'EpisodesController@update');
    Route::delete('titles/series/{series_id}/seasons/{season_number}/episodes/{episode_number}', 'EpisodesController@destroy');

    Route::get('/admin', function () {
        return view('admin.adminpage');
    });

    /** User */
    Route::resource('users', 'UsersController')->name('edit', 'edit');
    Route::get('/userpage', 'UsersController@index')->name('userpage');

    Route::resource('lists', 'ListsController')->name('index', 'lists');
    Route::get('userpage/lists/create', 'ListsController@create');
    Route::get('userpage/lists', 'ListsController@index')->name('userpage');
    Route::put('userpage/lists/{list}', 'ListsController@update');
    Route::delete('userpage/lists/{list}', 'ListsController@destroy');

    Route::put('userpage/settings/{user}', 'UsersController@update');
    Route::get('userpage/settings/{user}', 'UsersController@edit')->name('userpage');

    Route::get('userpage/reviews/', 'reviewsController@index')->name('userpage');
    Route::get('reviews/{review_id}/comments', 'CommentsController@index')->name('edit');
    Route::put('titles/{title}/rate', 'TitlesController@rate');

});

Route::get('titles/series/{series}', 'SeriesController@show')->name("title");
Route::get('titles/movies/{movie}', 'MoviesController@show')->name("title");

Route::get('titles/series/{series_id}/seasons', 'SeasonsController@index');
Route::get('titles/series/{series_id}/seasons/{season_number}', 'SeasonsController@show');

Route::get('titles/series/{series_id}/seasons/{season_number}/episodes', 'EpisodesController@index');
Route::get('titles/series/{series_id}/seasons/{season_number}/episodes/{episode_number}', 'EpisodesController@show')->name('title');

Route::resource('people', 'PeopleController');
Route::resource('comments', 'CommentsController');
Route::resource('reviews', 'ReviewsController');