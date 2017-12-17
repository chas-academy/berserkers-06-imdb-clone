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

class MovieSeeder extends Seeder
{
     /**
     * Run the database seeder.
     *
     * @return void
     */
    public function run()
    {
        $movieNames = [
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

        $client = new Client(['base_uri' => 'https://api.themoviedb.org/3/', 'delay' => 251]);

        foreach($movieNames as $movieName) {

            $response = $client->request('GET',"search/movie?api_key=be55d92a645f3fe8c6ca67ff5093076e&query={$movieName}");
            $response = json_decode($response->getBody());
            $movieId = $response->results[0]->id; 
            $response = $client->request('GET',"movie/{$movieId}?api_key=be55d92a645f3fe8c6ca67ff5093076e&append_to_response=credits,videos");
            $movie = json_decode($response->getBody());
            
            if (is_null(Movie::where('title', '=', $movie->title)->first())) {
                
                $title = Title::create(['type' => 'movie']);

                $movieArray = [
                'title_id' => $title->id,
                'title' => $movie->title, 
                'release_year' => $movie->release_date,
                'plot_summary' => $movie->overview, 
                'runtime' => (int) $movie->runtime, 
                ];

                if (isset($movie->production_countries[0])) {

                    $countries = '';

                    foreach($movie->production_countries as $result) {

                        if (count($movie->production_countries) > 1 ) {

                            $countries .= $result->iso_3166_1 . ', ';

                        } else {

                            $countries .= $result->iso_3166_1;
                        }
                    }

                    $movieArray += ['countries' => $countries];
                }

                if (isset($movie->videos->results[0])) {

                    $movieArray += ['trailer' => "https://www.youtube.com/watch?v={$movie->videos->results[0]->key}"];
                }

                // if (isset($movie->content_ratings->results[0] )) {
                //     foreach($movie->content_ratings->results as $result) {
                //         if ($result->iso_3166_1 === "US") {
                //             $movieArray += ['pg_rating' => $result->rating];
                //         }
                //     }  
                // } //content ratings cant be accesed with this api, they will have to be filled in manualy for all movies

                $request = [];

                foreach($movieArray as $key => $value) {

                    if (isset($value) && $value != null) {

                        $request += [$key => $value];
                    }
                }
                
                Movie::create($request);

                if (isset($movie->genres)){

                    foreach($movie->genres as $apiGenre){

                        $genre = Genre::where('name', '=', $apiGenre->name)->first();

                        if(!isset($genre)) {

                            $genre = Genre::create(['name' => $apiGenre->name]);
                        }

                        $title->genres()->attach($genre->id);
                    }
                }

                $imgSizes = ["45", "92", "154","185","300","342","500","632", "780","1280"];

                if (isset($movie->poster_path)){

                    foreach($imgSizes as $size) {

                        Photo::create([
                            'imageable_id' => $title->id,
                            'imageable_type' => get_class($title),
                            'photo_path' => "https://image.tmdb.org/t/p/w{$size}{$movie->poster_path}", 
                            'photo_type' => 'poster',
                            'width' => $size,
                            'ratio' => 0.66666666666667
                        ]);
                    }     
                }

                if (isset($movie->backdrop_path)) {

                    foreach($imgSizes as $size) {

                        Photo::Create([
                            'imageable_id' => $title->id, 
                            'imageable_type' => get_class($title),
                            'photo_path' => "https://image.tmdb.org/t/p/w{$size}{$movie->backdrop_path}", 
                            'photo_type' => 'backdrop',
                            'width' => $size,
                            'ratio' => 1.777777777777778
                        ]);
                    }
                }  

                if (isset($movie->credits)) {

                    if (isset($movie->credits->cast)) {

                        foreach($movie->credits->cast as $cast) {

                            $person = Person::where('name', '=', $cast->name)->first();

                            if (!isset($person)) {
        
                                $name = str_replace(' ', '+', $cast->name);
                                
                                $request = $client->request('GET', "search/person?api_key=be55d92a645f3fe8c6ca67ff5093076e&query={$name}");
                                $request = json_decode($request->getBody());

                                if (isset($request->results[0])) {

                                    $personId = $request->results[0]->id;
                                    
                                    $response= $client->request('GET', "person/{$personId}?api_key=be55d92a645f3fe8c6ca67ff5093076e&append_to_response=images");
                                    $response= json_decode($response->getBody());

                                    $request = [
                                        'name' => $response->name,
                                        'bio' => $response->biography
                                    ];

                                    if (isset($response->birthday) && strlen($response->birthday) === 10) {

                                        $request += ['b_date' => $response->birthday];
                                    }

                                    if (isset($response->deathday) && strlen($response->deathday) === 10) {

                                        $request += ['d_date' => $response->deathday];
                                    }
                                    
                                    $person = Person::create($request);

                                    if (isset($response->images->profiles)) {

                                        foreach ($response->images->profiles as $profile) {

                                            foreach($imgSizes as $size) {

                                                Photo::Create([
                                                    'imageable_id' => $person->id, 
                                                    'imageable_type' => get_class($person),
                                                    'photo_path' => "https://image.tmdb.org/t/p/w{$size}{$profile->file_path}", 
                                                    'photo_type' => 'profile',
                                                    'width' => $size,
                                                    'ratio' => $profile->aspect_ratio
                                                ]);
                                            }
                                        }
                                    }
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
                                    $request = $client->request('GET', "search/person?api_key=be55d92a645f3fe8c6ca67ff5093076e&query={$name}");
                                    $request = json_decode($request->getBody());

                                    if (isset($request->results[0])) {

                                        $personId = $request->results[0]->id;
                                        $person = $client->request('GET', "person/{$personId}?api_key=be55d92a645f3fe8c6ca67ff5093076e&append_to_response=images");
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

                                        if (isset($response->images->profiles)) {

                                            foreach ($response->images->profiles as $profile) {

                                                foreach($imgSizes as $size) {

                                                    Photo::Create([
                                                        'imageable_id' => $person->id, 
                                                        'imageable_type' => get_class($person),
                                                        'photo_path' => "https://image.tmdb.org/t/p/w{$size}{$profile->file_path}", 
                                                        'photo_type' => 'profile',
                                                        'width' => $size,
                                                        'ratio' => $profile->aspect_ratio
                                                    ]);
                                                }
                                            }
                                        }
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
