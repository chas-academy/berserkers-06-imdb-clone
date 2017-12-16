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
        $movie_names = [
            'Magnolia',
            'Up',
            'Pulp+Fiction',
            'The+Mask',
            'Cowspiracy',
            'Office+Space',
            'Minority+Report',
            'Eternal+Sunshine+of+the+Spotless+Mind',
            'Forrest+Gump',
            'Inception',
            'Fight+Club',
            'City+of+God',
            'Se7en', 
            'Spirited+Away', 
            'Casablanca',
            'Psycho',
            'Rear+Window',
            'Gladiator',
            'Memento',
            'Th+Lives+of+Others',
            'Vertigo',
            'Braveheart',
            'Amélie',
            'Amadeus',
            'A+Clockwork+Orange',
            'My+Neighbor+Totoro',
            'The+Truman+Show',
            'Monsters,+Inc.',
            'Jaws'
        ];

        $db_client = new Client(['base_uri' => 'https://api.themoviedb.org/3/', 'delay' => 251]);

        foreach($movie_names as $movie_name) {
            
            $response = $db_client->request('GET',"search/movie?api_key=be55d92a645f3fe8c6ca67ff5093076e&query={$movie_name}");
            $response = json_decode($response->getBody());
            $movie_id = $response->results[0]->id; 
            $response = $db_client->request('GET',"movie/{$movie_id}?api_key=be55d92a645f3fe8c6ca67ff5093076e&append_to_response=credits,videos");
            $movie = json_decode($response->getBody());
            
            if (is_null(Movie::where('title', '=', $movie->title)->first())) {
                
                $title = Title::create(['type' => 'movie']);
                $movie_array = [
                'title_id' => $title->id,
                'title' => $movie->title, 
                'release_year' => $movie->release_date,
                'plot_summary' => $movie->overview, 
                'runtime' => (int) $movie->runtime, 
                
                ];

                if (isset($movie->production_countries[0])) {
                    $countries = '';
                    foreach($movie->production_countries[0] as $result) {
                        $countries .= $movie->production_countries[0]->iso_3166_1 . ' ';
                    }

                    $movie_array += ['countries' => $countries];
                }

                if (isset($movie->videos->results[0])) {
                    $movie_array += ['trailer' => "https://www.youtube.com/watch?v={$movie->videos->results[0]->key}"];
                }

                // if (isset($movie->content_ratings->results[0] )) {
                //     foreach($movie->content_ratings->results as $result) {
                //         if ($result->iso_3166_1 === "US") {
                //             $movie_array += ['pg_rating' => $result->rating];
                //         }
                //     }  
                // } //content ratings cant be accesed with this api, they will have to be filled in manualy for all movies

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

                $img_sizes= ["w45", "w92", "w154","w185","w300","w342","w500","h632", "w780","w1280"];

                if (isset($movie->poster_path)){
                        foreach($img_sizes as $size) {
                            Photo::create(['title_id' => $title->id, 'photo_path' => "https://image.tmdb.org/t/p/{$size}/{$movie->poster_path}"]);
                        }     
                }

                if (isset($movie->backdrop_path)){
                    foreach($img_sizes as $size) {
                        Photo::create(['title_id' => $title->id, 'photo_path' => "https://image.tmdb.org/t/p/{$size}/{$movie->backdrop_path}"]);
                    }
                }  

                if (isset($movie->credits)) {
                    if (isset($movie->credits->cast)) {
                        foreach($movie->credits->cast as $cast) {
                            $person = Person::where('name', '=', $cast->name)->first();
                            if (!isset($person)) {
        
                                $name = str_replace(' ', '+', $cast->name);
                                
                                $request = $db_client->request('GET', "search/person?api_key=be55d92a645f3fe8c6ca67ff5093076e&query={$name}");
                                $request = json_decode($request->getBody());

                                if (isset($request->results[0])) {
                                    $person_id = $request->results[0]->id;
                                    
                                    $person = $db_client->request('GET', "person/{$person_id}?api_key=be55d92a645f3fe8c6ca67ff5093076e");
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
            
                                $person->characters()->attach($character->id, ['title_id' => $title->id]);
                            }
                        }
                    }

                    if (isset($movie->credits->crew)) {
                        foreach($movie->credits->crew as $crew) {
                            if ($crew->job === "Director" || $crew->department === "Production" || $crew->department === "Writing") {
                                $person = Person::where('name', '=', $crew->name)->first();
                                if (!isset($person)) {
            
                                    $name = str_replace(' ', '+', $crew->name);
                                    $request = $db_client->request('GET', "search/person?api_key=be55d92a645f3fe8c6ca67ff5093076e&query={$name}");
                                    $request = json_decode($request->getBody());

                                    if (isset($request->results[0])) {
                                        $person_id = $request->results[0]->id;
                                        $person = $db_client->request('GET', "person/{$person_id}?api_key=be55d92a645f3fe8c6ca67ff5093076e");
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
                                        $person->directorOfTitles()->attach($title->id);
                                    }
                                    
                                    if ($crew->department === "Production") {
                                        $person->producerOfTitles()->attach($title->id);
                                    }

                                    if ($crew->department === "Writing") {
                                        $person->screenwriterOfTitles()->attach($title->id);
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
