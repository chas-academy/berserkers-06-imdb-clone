<?php

namespace App\Http\Controllers;

use App\Movie;
use App\Title;
use App\Genre;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
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
        $id = $movie->title_id;
        $movie = Movie::find($id);
        $title = Title::find($id);
        $genres = $this->formatForEditing($title->genres);
        $directors = $this->formatForEditing($title->directors);
        $producers = $this->formatForEditing($title->producers);
        $screenwriters = $this->formatForEditing($title->screenwriters);
        $actorsAsCharacters = $this->formatForEditing($title->characters);
        

        session(['title_id' => $id]);

        return view('titles/movies.edit', ['movie' => $movie, 'title' => $title, 'genres' => $genres]);
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
        $id = $movie->title_id;
        $title = Title::find($id);

        $movieColumns = ['title', 'release_year', 'plot_summary', 'runtime', 'countries', 'pg_rating', 'trailer'];

        if ($request->has('genres')) {
            $genreNames = explode("\r\n",$request->get('genres'));
            
            $genresIds = [];

            foreach ($genreNames as $genreName) {
                $genre = Genre::firstOrCreate(['name' => $genreName]);
                array_push($genresIds, $genre->id);
            }

            $title->genres()->sync($genresIds);

            return redirect("/titles/movies/$id/edit"); 
        }
        
        foreach($movieColumns as $column) {

            if ($request->has($column)) {

                $movie->$column = $request->get($column);
                $movie->save();
                
                return redirect("/titles/movies/$id/edit");           
            } 
        }

       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        //
    }

    protected function formatForEditing($items) {

        $collection = "";

            foreach($items as $key => $item) {
                if (!isset($items[0]->actor)) {
                
                    if(isset($items[$key +1] )) {

                        $collection .= $item->name . "\n";

                    } else {

                        $collection .= $item->name;
                    }
            
                 } else {

                    foreach($item->actor as $actor) {
                       
                        if(isset($items[$key +1] )) {
                            
                            $collection .= $actor->name . ' As ' . $item->character_name . "\n";

                        } else {

                            $collection .= $actor->name . ' As ' . $item->character_name;
                        }
                    }
                }
            }

        return $collection;
    }
}
