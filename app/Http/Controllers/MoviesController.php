<?php

namespace App\Http\Controllers;

use App\Movie;
use App\Title;
use App\Photo;
use Illuminate\Http\Request;
use App\Traits\DatabaseHelpers;
use Illuminate\Support\Facades\Auth;

class MoviesController extends Controller
{
   
    const ITEMCOLUMNS = ['title', 'release_year', 'plot_summary', 'runtime', 'countries', 'pg_rating', 'trailer'];
    const PIVOTTABLES = ['genres', 'directors', 'producers', 'screenwriters','actorsAsCharacters', 'photos' ];

    use DatabaseHelpers;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $movies = Movie::all();
        $titles = Title::where('type', '=', 'movie')->get();

        return view('titles/movies.index', ['movies' => $movies, 'titles' => $titles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        //
        $id = $movie->title_id;
        $movie = Movie::find($id);
        $title = Title::find($id);
        session(['title_id' => $id]);

        return view('titles/movies.show', ['movie' => $movie, 'title' => $title]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        if (Auth::user()->role === 1) {
            $id = $movie->title_id;
            $movie = Movie::find($id);
            $title = Title::find($id);
            $genres = $this->formatForEditing($title->genres);
            $directors = $this->formatForEditing($title->directors);
            $producers = $this->formatForEditing($title->producers);
            $screenwriters = $this->formatForEditing($title->screenwriters);
            $actorsAsCharacters = $this->formatForEditing($title->characters);
            $photos = $this->formatForEditing($title->photos);

            session(['title_id' => $id]);

            return view('titles/movies.edit', [
                'movie' => $movie, 
                'title' => $title, 
                'genres' => $genres, 
                'directors' => $directors, 
                'producers' => $producers, 
                'screenwriters' => $screenwriters,
                'actorsAsCharacters' => $actorsAsCharacters,
                'photos' => $photos
                ]);
        }

        return redirect("/titles/movies/{$movie->title_id}"); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    { 
        if (Auth::user()->role === 1) {
            $this->updateItem($request, $movie);

            $path = $request->path();

            return redirect("$path/edit"); 
        }

        return redirect("/titles/movies/{$movie->title_id}"); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        if (Auth::user()->role === 1) {
            $id = $movie->title_id;
            $title = Title::find($id);

            try{
            $this->detachAllFromItemAndDelete($title, Movie::class , $id);
            } catch(Exception $e) {
                $dd($e);
            }
        
            return redirect("/titles/movies/");  
        }

        return redirect("/");  
    }
}

