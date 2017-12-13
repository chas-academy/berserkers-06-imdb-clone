<?php

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Character;
use App\Person;
use App\Movie;
use App\Genre;
use App\Photo;
use App\Title;

class SerieMoviePersonSeeder extends Seeder
{
     /**
     * Run the database seeder.
     *
     * @return void
     */
    public function run()
    {
        $movie_names= ['Magnolia','Up', 'Pulp+Fiction', 'The+Mask','Cowspiracy'];
        $moviedb_client = new Client(['base_uri' => 'https://api.themoviedb.org/3/', 'delay' => 300]);
        $imdb_client = new Client(['base_uri' => 'https://theimdbapi.org/api/']);
        foreach($movie_names as $movie_name) {
            $response = $moviedb_client->request('GET',"search/movie?api_key=be55d92a645f3fe8c6ca67ff5093076e&query={$movie_name}");
            $response = json_decode($response->getBody());
            $movie_id = $response->results[0]->id; 
            $response = $moviedb_client->request('GET',"movie/{$movie_id}?api_key=be55d92a645f3fe8c6ca67ff5093076e&append_to_response=credits,videos,images");
            $movie = json_decode($response->getBody());
            
            $imdb_id = $movie->imdb_id;
          
            $response = $imdb_client->request('GET',"movie?movie_id={$imdb_id}");
            $imdb_movie = json_decode($response->getBody());
            
            if (is_null(Movie::where('title', '=', $movie->title)->first())) {
                
                $title = Title::create(['type' => 'movie']);
                $movie_array = [
                'title_id' => $title->id,
                'title' => $movie->title, 
                'release_year' => $movie->release_date,
                'plot_summary' => $imdb_movie->storyline, 
                'runtime' => (int) $movie->runtime, 
                'countries' => $imdb_movie->metadata->countries[0], 
                'pg_rating' => $imdb_movie->content_rating, 
                ];
                if (isset($imdb_movie->trailer[0])) {
                    $movie_array += ['trailer' => $imdb_movie->trailer[0]->videoUrl];
                }

                $request = [];

                foreach($movie_array as $key => $value) {
                    if (isset($value) && $value != null) {
                    $request += [$key => $value];
                    }
                }
                
                Movie::create($request);

                if (isset($movie->genres)){
                    foreach($movie->genres as $api_genre){
                        $genre = Genre::where('name', '=', $api_genre->name)->first();
                        if(!isset($genre)) {
                            $genre = Genre::create(['name' => $api_genre->name]);
                        }
                        $title->genres()->attach($genre->id);
                    }
                }

                
                if (isset($imdb_movie->poster)){
                    foreach($imdb_movie->poster as $photo){
                        
                        Photo::create(['title_id' => $title->id, 'photo_path' => $photo]);
                        
                    }
                }
                if (isset($movie->credits)) {
                    if (isset($movie->credits->cast)) {
                        foreach($movie->credits->cast as $cast) {
                            $person = Person::where('name', '=', $cast->name)->first();
                            if (!isset($person)) {
        
                                $name = str_replace(' ', '+', $cast->name);
                                
                                $request = $moviedb_client->request('GET', "search/person?api_key=be55d92a645f3fe8c6ca67ff5093076e&query={$name}");
                                $request = json_decode($request->getBody());

                                if (isset($request->results[0])) {
                                    $person_id = $request->results[0]->id;
                                    
                                    $person = $moviedb_client->request('GET', "person/{$person_id}?api_key=be55d92a645f3fe8c6ca67ff5093076e");
                                    $person = json_decode($person->getBody());

                                    $request = [
                                        'name' => $person->name,
                                        'bio' => $person->biography
                                    ];

                                    if (isset($person->birthday) && strlen($person->birthday) === 10) {
                                        $request += ['b_date' => $person->birthday];
                                    }

                                    if (isset($person->deathday) && strlen($person->deathday) === 10) {
                                        $request += ['d_date' => $person->deathday];
                                    }
                                    
                                    $person = Person::create($request);
                                }

                            }
                            if (isset($person)) {
                                $character = Character::where('character_name', '=', $cast->character)->first();
                                
                                if (!isset($character)) {
                                $character = Character::create(['character_name' => $cast->character]);
                                
                                }
            
                                $person->title_characters()->attach($character->id, ['title_id' => $title->id]);
                            }
                        }
                    }
                    if (isset($movie->credits->crew)) {
                        foreach($movie->credits->crew as $crew) {
                            if ($crew->job === "Director" || $crew->department === "Production" || $crew->department === "Writing") {
                                $person = Person::where('name', '=', $crew->name)->first();
                                if (!isset($person)) {
            
                                    $name = str_replace(' ', '+', $crew->name);
                                    $request = $moviedb_client->request('GET', "search/person?api_key=be55d92a645f3fe8c6ca67ff5093076e&query={$name}");
                                    $request = json_decode($request->getBody());

                                    if (isset($request->results[0])) {
                                        $person_id = $request->results[0]->id;
                                        $person = $moviedb_client->request('GET', "person/{$person_id}?api_key=be55d92a645f3fe8c6ca67ff5093076e");
                                        $person = json_decode($person->getBody());

                                        $request = [
                                            'name' => $person->name,
                                            'bio' => $person->biography
                                        ];
                                        

                                        if (isset($person->birthday) && strlen($person->birthday) === 10 ) {
                                            $request += ['b_date' => $person->birthday];
                                        }

                                        if (isset($person->deathday) && strlen($person->deathday) === 10) {
                                            $request += ['d_date' => $person->deathday];
                                        }
                                        
                                        $person = Person::create($request);
                                    }
                                }
                                if (isset($person)) {

                                    if ($crew->job === "Director") {
                                        $person->director_of_title()->attach($title->id);
                                    }
                                    
                                    if ($crew->department === "Production") {
                                        $person->producer_of_title()->attach($title->id);
                                    }

                                    if ($crew->department === "Writing") {
                                        $person->screenwriter_of_title()->attach($title->id);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }    
    }
}
