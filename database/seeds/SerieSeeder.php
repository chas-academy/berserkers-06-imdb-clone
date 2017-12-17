<?php

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Character;
use App\Episode;
use App\Person;
use App\Series;
use App\Season;
use App\Genre;
use App\Photo;
use App\Title;

class SerieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ini_set('max_execution_time', 3000);
        $series_names= [
            'Westworld',
            'Preacher',
            'Penny+Dreadful',
            'The+Affair',
            'Breaking+Bad',
            'Black+Mirror',
            'Friends',
            'Game+Of+Thrones',
            'The+Walking+Dead',
            'The+Office',
            'Twin+Peaks',
        ];
        $db_client = new Client(['base_uri' => 'https://api.themoviedb.org/3/', 'delay' => 251]);
        foreach($series_names as $series_name) {
            $response = $db_client->request('GET',"search/tv?api_key=be55d92a645f3fe8c6ca67ff5093076e&query={$series_name}");
            $response = json_decode($response->getBody());
            $series_id = $response->results[0]->id; 
            
            $response = $db_client->request('GET',"tv/{$series_id}?api_key=be55d92a645f3fe8c6ca67ff5093076e&append_to_response=external_ids,content_ratings,videos,credits");
            $series = json_decode($response->getBody());
     
            if (is_null(Series::where([['title', '=', $series->name],['countries', '=',$series->origin_country[0]]])->first())) {
                
                $title = Title::create(['type' => 'series']);
                $series_array = [
                'title_id' => $title->id,
                'title' => $series->name, 
                'release_year' => $series->first_air_date,
                'plot_summary' => $series->overview, 
                'countries' => $series->origin_country[0], 
                'num_of_seasons' => $series->number_of_seasons,
                'num_of_episodes' => $series->number_of_episodes
                ];

                if (isset($series->videos->results[0])) {
                    $series_array += ['trailer' => "https://www.youtube.com/watch?v={$series->videos->results[0]->key}"];
                }

                if ($series->status !== "Returning Series" ) {
                    $series_array += ['end_date' => $series->last_air_date];
                }

                if (isset($series->content_ratings->results[0] )) {
                    foreach($series->content_ratings->results as $result) {
                        if ($result->iso_3166_1 === "US") {
                            $series_array += ['pg_rating' => $result->rating];
                        }
                    }  
                }

                $request = [];

                foreach($series_array as $key => $value) {
                    if (isset($value) && $value != null) {
                    $request += [$key => $value];
                    }
                }
               
                Series::create($request);

                if (isset($series->genres)){
                    foreach($series->genres as $api_genre){
                        $genre = Genre::where('name', '=', $api_genre->name)->first();
                        if(!isset($genre)) {
                            $genre = Genre::create(['name' => $api_genre->name]);
                        }
                        $title->genres()->attach($genre->id);
                    }
                }

                $img_sizes = ["45", "92", "154","185","300","342","500","632", "780","1280"];

                if (isset($series->poster_path)){
                    foreach($img_sizes as $size) {
                        Photo::create([
                            'imageable_id' => $title->id,
                            'imageable_type' => get_class($title),
                            'photo_path' => "https://image.tmdb.org/t/p/w{$size}{$series->poster_path}", 
                            'photo_type' => 'poster',
                            'width' => $size,
                            'ratio' => 0.66666666666667
                            ]);
                    }     
                }

                if (isset($series->backdrop_path)) {
                    foreach($img_sizes as $size) {
                        Photo::Create([
                            'imageable_id' => $title->id, 
                            'imageable_type' => get_class($title),
                            'photo_path' => "https://image.tmdb.org/t/p/w{$size}{$series->backdrop_path}", 
                            'photo_type' => 'backdrop',
                            'width' => $size,
                            'ratio' => 1.777777777777778
                            ]);
                    }
                } 

                if (isset($series->created_by)){
                    foreach($series->created_by as $creator){
                        $person = Person::where('name', '=', $creator->name)->first();
                        if (!isset($person)) {

                            $name = str_replace(' ', '+', $creator->name);
                            $request = $db_client->request('GET', "search/person?api_key=be55d92a645f3fe8c6ca67ff5093076e&query={$name}");
                            $request = json_decode($request->getBody());

                            if (isset($request->results[0])) {
                                $person_id = $request->results[0]->id;
                                $person = $db_client->request('GET', "person/{$person_id}?api_key=be55d92a645f3fe8c6ca67ff5093076e&append_to_response=images");
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
                        $person->creatorOfTitles()->attach($title->id);
                        foreach($series->credits->crew as $crew) {
                            if ($crew->department === "Production") {
                                $person->producerOfTitles()->attach($title->id);
                            }
                        }
                    }
                }

                if (!is_null($series->seasons)){
                    $season_num = $series->seasons[0]->season_number;
                    foreach($series->seasons as $season){
                        if ($season_num != 0) {
                            $season_title = Title::create(['type' => 'season']);
                            Season::create(['title_id' => $season_title->id, 'series_id' => $title->id, 'season_number' => $season_num]);
                            
                            for($episode_num = 1; $episode_num <= $season->episode_count; $episode_num++) {
                                
                                $response = $db_client->request('GET',"tv/{$series_id}/season/{$season_num}/episode/{$episode_num}?api_key=be55d92a645f3fe8c6ca67ff5093076e&append_to_response=credits");
                                $db_episode = json_decode($response->getBody());
                                
                                if (is_null(Episode::where([['name', '=', $db_episode->name], ['season_id', '=', $season_title->id]])->first())) {
                                    
                                    $episode = Title::create(['type' => 'episode']);
                                
                                    $episode_array = [
                                    'title_id' => $episode->id,
                                    'season_id' => $season_title->id,
                                    'name' => $db_episode->name, 
                                    'episode_number' => $episode_num,
                                    'plot_summary' => $db_episode->overview,
                                    'air_date' => $db_episode->air_date,
                                    ];

                                    $request = [];
                                    
                                    foreach($episode_array as $key => $value) {
                                        if (isset($value) && $value != null) {
                                        $request += [$key => $value];
                                        }
                                    }
                                
                                    Episode::create($request);

                                    if (isset($db_episode->images->stills)){
                                        foreach($db_episode->images->stills as $still) {
                                            foreach($img_sizes as $size) {
                                                Photo::create([
                                                    'imageable_id' => $episode->id,
                                                    'imageable_type' => get_class($episode),
                                                    'photo_path' => "https://image.tmdb.org/t/p/w{$size}{$still->file_path}", 
                                                    'photo_type' => 'backdrop',
                                                    'width' => $size,
                                                    'ratio' => $still->aspect_ratio
                                                    ]);
                                            }  
                                        }
                                           
                                    }

                                    if (isset($db_episode->credits)) {
                                        if (isset($db_episode->credits->cast)) {
                                            foreach($db_episode->credits->cast as $cast) {
                                                $person = Person::where('name', '=', $cast->name)->first();
                                                if (!isset($person)) {
                            
                                                    $name = str_replace(' ', '+', $cast->name);
                                                    
                                                    $request = $db_client->request('GET', "search/person?api_key=be55d92a645f3fe8c6ca67ff5093076e&query={$name}");
                                                    $request = json_decode($request->getBody());
                                                    
                                                    if (isset($request->results[0])) {
                                                        $person_id = $request->results[0]->id;
                                                        
                                                        $response = $db_client->request('GET', "person/{$person_id}?api_key=be55d92a645f3fe8c6ca67ff5093076e&append_to_response=images");
                                                       
                                                        $response = json_decode($response->getBody());
                                                        
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
                                                                foreach($img_sizes as $size) {
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
                                
                                                    $person->characters()->attach($character->id, ['title_id' => $episode->id]);
                                                }
                                            }
                                        }
                                        if (isset($db_episode->credits->guest_stars)) {
                                            foreach($db_episode->credits->guest_stars as $guest_stars) {
                                                $person = Person::where('name', '=', $guest_stars->name)->first();
                                                if (!isset($person)) {
                            
                                                    $name = str_replace(' ', '+', $guest_stars->name);
                                                    
                                                    $request = $db_client->request('GET', "search/person?api_key=be55d92a645f3fe8c6ca67ff5093076e&query={$name}");
                                                    $request = json_decode($request->getBody());
                    
                                                    if (isset($request->results[0])) {
                                                        $person_id = $request->results[0]->id;
                                                        
                                                        $person = $db_client->request('GET', "person/{$person_id}?api_key=be55d92a645f3fe8c6ca67ff5093076e&append_to_response=images");
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

                                                        if (isset($response->images->profiles)) {
                                                            foreach ($response->images->profiles as $profile) {
                                                                foreach($img_sizes as $size) {
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
                                                    $character = Character::where('character_name', '=', $guest_stars->character)->first();
                                                    
                                                    if (!isset($character)) {
                                                    $character = Character::create(['character_name' => $guest_stars->character]);
                                                    
                                                    }
                                
                                                    $person->characters()->attach($character->id, ['title_id' => $episode->id]);
                                                }

                                            
                                            }
                                        }
                                        if (isset($db_episode->credits->crew)) {
                                            foreach($db_episode->credits->crew as $crew) {
                                                if ($crew->job === "Director" || $crew->department === "Production" || $crew->department === "Writing") {
                                                    $person = Person::where('name', '=', $crew->name)->first();
                                                    if (!isset($person)) {
                                
                                                        $name = str_replace(' ', '+', $crew->name);
                                                        $request = $db_client->request('GET', "search/person?api_key=be55d92a645f3fe8c6ca67ff5093076e&query={$name}");
                                                        $request = json_decode($request->getBody());
                    
                                                        if (isset($request->results[0])) {
                                                            $person_id = $request->results[0]->id;
                                                            $person = $db_client->request('GET', "person/{$person_id}?api_key=be55d92a645f3fe8c6ca67ff5093076e&append_to_response=images");
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
                                                                    foreach($img_sizes as $size) {
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
                                                            $person->directorOfTitles()->attach($episode->id);
                                                        }
                                                        
                                                        if ($crew->department === "Production") {
                                                            $person->producerOfTitles()->attach($episode->id);
                                                        }
                    
                                                        if ($crew->department === "Writing") {
                                                            $person->screenwriterOfTitles()->attach($episode->id);
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        $season_num++;
                    }
                }
            }
        }  
    }
}
