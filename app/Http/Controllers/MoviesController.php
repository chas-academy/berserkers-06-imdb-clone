<?php

namespace App\Http\Controllers;

use App\Character;
use App\Person;
use App\Movie;
use App\Title;
use App\Genre;
use App\Photo;
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
        $pivotTables = ['genres', 'directors', 'producers', 'screenwriters','actorsAsCharacters', 'photos' ];

        foreach($pivotTables as $pivot) {
            if ($request->has($pivot)) {
                if ($request->has('actorsAsCharacters')) {
                    $names = preg_split("/(\r\n| As )/",$request->get($pivot));
                    $personsIds = [];
                    $charactersIds = [];
                    for ($i = 0; $i < count($names); $i++) {
                        if ( ($i % 2) === 0) {
                            $table = Person::firstOrCreate(['name' => $names[$i]]);
                            array_push($personsIds, $table->id);
                        } else {
                            $table = Character::firstOrCreate(['character_name' => $names[$i]]);
                            array_push($charactersIds, ['character_id' => $table->id]);
                        }
                    }

                    $actorsAsCharactersIds = array_combine($personsIds, $charactersIds);
                    
                    $title->actors()->sync($actorsAsCharactersIds);

                } elseif($request->has('photos')) {

                    $photos = explode("\r\n",$request->get($pivot));
                    foreach($photos as $key => $photo) {
                        $keyvalues = (explode(' | ', $photo));
                        $photovalues = [];
                        foreach ($keyvalues as $newkey => $keyvalue) {

                            $keyvalues[$newkey] = explode(': ', $keyvalue);
                            $photovalues[$keyvalues[$newkey][0]] = $keyvalues[$newkey][1];
                        }
                        $photos[$key] = $photovalues;
                
                    }
                    $photosIds = [];

                   foreach($photos as $photo) {
                       $item = $title->photos()->where('photo_path', $photo['photo_path'])->get(['*']);
                       
                       if (!isset($item[0])) {

                        $item = Photo::create([

                            'imageable_id' => $title->id,
                            'imageable_type' => get_class($title),
                            'photo_path' => $photo['photo_path'], 
                            'photo_type' => $photo['photo_type'],
                            'width' => $photo['width'],
                            'ratio' => $photo['ratio']
                            ]);

                            array_push($photosIds, $item->id);

                       } else {

                        array_push($photosIds, $item[0]->id);
                       }
                   }
                   $tobeRemoved = $title->photos()->whereNotIn('id', $photosIds);
                   
                   foreach($tobeRemoved->get(['id']) as $photo) {
                        Photo::where('id', '=', $photo->id)->delete();
                   }
                   
                    
                } else {

                    $names = explode("\r\n",$request->get($pivot));
                    $pivotIds = [];
        
                    foreach ($names as $name) {

                        if ($pivot === 'genres') {

                            $table = Genre::firstOrCreate(['name' => $name]);
                            array_push($pivotIds, $table->id);

                        } else {
                            $table = Person::firstOrCreate(['name' => $name]);
                            
                            array_push($pivotIds, $table->id);
                        }
                    }
                    $title->$pivot()->sync($pivotIds);
                }

                return redirect("/titles/movies/$id/edit"); 
            }

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
        $id = $movie->title_id;
        $title = Title::find($id);
        try{
            $title->directors()->detach();
            $title->producers()->detach();
            $title->screenwriters()->detach();
            $title->genres()->detach();
            $title->actors()->detach();
            $title->ratings()->detach();
            Movie::where('title_id', '=', $id)->delete();
            Photo::where('imageable_id' ,'=' , $id)->delete();
            Title::where('id', '=', $id)->delete();
        } catch(Exception $e) {
            $dd($e);
        }
       

        return redirect("/titles/movies/");  


    }

    protected function formatForEditing($items) {

        $collection = "";

            foreach($items as $key => $item) {
                if (isset($items[0]->photo_path)) {
            
                    $collection .= 'photo_path: ' . $item->photo_path . ' | photo_type: ' . $item->photo_type . ' | width: ' . $item->width . ' | ratio: ' . $item->ratio;
                    
                    if(isset($items[$key +1] )) {

                        $collection .= "\n";
                    }
                    
            
                 } elseif (isset($items[0]->actor)) {

                    foreach($item->actor as $actor) {
                       
                        if(isset($items[$key +1] )) {
                            
                            $collection .= $actor->name . ' As ' . $item->character_name . "\n";

                        } else {

                            $collection .= $actor->name . ' As ' . $item->character_name;
                        }
                    }
                } else {

                    if(isset($items[$key +1] )) {
                        
                        $collection .= $item->name . "\n";

                    } else {

                        $collection .= $item->name;
                    }

                }
            }

        return $collection;
    }
}
