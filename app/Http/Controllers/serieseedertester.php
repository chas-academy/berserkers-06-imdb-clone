<?php

namespace App\Http\Controllers;

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

class serieseedertester extends Controller
{
    public function index() {
        
        $series_names= ['Westworld'];
        $db_client = new Client(['base_uri' => 'https://api.themoviedb.org/3/', 'delay' => 300]);
        $imdb_client = new Client(['base_uri' => 'https://theimdbapi.org/api/', 'delay' => 1000]);
        foreach($series_names as $series_name) {
            $response = $db_client->request('GET',"search/tv?api_key=be55d92a645f3fe8c6ca67ff5093076e&query={$series_name}");
            $response = json_decode($response->getBody());
            $series_id = $response->results[0]->id; 
            
            $response = $db_client->request('GET',"tv/{$series_id}?api_key=be55d92a645f3fe8c6ca67ff5093076e&append_to_response=external_ids");
            $series = json_decode($response->getBody());
            
            $imdb_id = $series->external_ids->imdb_id;
         
            $response = $imdb_client->request('GET',"movie?movie_id={$imdb_id}");
            $imdb_series = json_decode($response->getBody());
     
            if (is_null(Series::where('title', '=', $series->name)->first())) {
                
                $title = Title::create(['type' => 'series']);
                $series_array = [
                'title_id' => $title->id,
                'title' => $series->name, 
                'release_year' => $series->first_air_date,
                'plot_summary' => $imdb_series->storyline, 
                'countries' => $imdb_series->metadata->countries[0], 
                'pg_rating' => $imdb_series->content_rating, 
                'num_of_seasons' => $series->number_of_seasons,
                'num_of_episodes' => $series->number_of_episodes
                ];
                if (isset($imdb_series->trailer[0])) {
                    $series_array += ['trailer' => $imdb_series->trailer[0]->videoUrl];
                }
                if ($series->status !== "Returning Series" ) {
                    $series_array += ['end_date' => $series->last_air_date];
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

                
                if (isset($imdb_series->poster)){
                    foreach($imdb_series->poster as $photo){
                        
                        Photo::create(['title_id' => $title->id, 'photo_path' => $photo]);
                        
                    }
                }

                if (!is_null($series->seasons)){
                    $season_num = 1;
                    foreach($series->seasons as $season){
                        $season = Title::create(['type' => 'season']);
                        Season::create(['title_id' => $season->id, 'series_id' => $title->id, 'season_number' => $season_num]);
                        for($episode_num = 1; $episode_num <= $season->episode_count; $episode_num++) {
                          
                            $response = $db_client->request('GET',"tv/{$series_id}/season/{$seasons_num}/episode/{$episode_num}?api_key=be55d92a645f3fe8c6ca67ff5093076e&append_to_response=credits,external_ids");
                            $db_episode = json_decode($response->getBody());

                            $imdb_id = $db_episode->external_ids->imdb_id;

                            $response = $imdb_client->request('GET',"movie?movie_id={$imdb_id}");
                            $imdb_episode = json_decode($response->getBody());
                            
                            if (is_null(Episode::where(['name', '=', $db_episode->name], ['season_id', '=', $season->id])->first())) {
                                
                                $episode = Title::create(['type' => 'episode']);
                            
                                $episode_array = [
                                'title_id' => $episode->id,
                                'season_id' => $season->id,
                                'name' => $db_episode->name, 
                                'episode_number' => $episode_num,
                                'plot_summary' => $imdb_series->storyline,
                                'air_date' => $db_episode->air_date,
                                ];

                                $request = [];
                                
                                foreach($episode_array as $key => $value) {
                                    if (isset($value) && $value != null) {
                                    $request += [$key => $value];
                                    }
                                }
                            
                                Episode::create($request);

                                if (isset($episode->credits)) {
                                    if (isset($episode->credits->cast)) {
                                        foreach($episode->credits->cast as $cast) {
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
                            
                                                $person->characters()->attach($character->id, ['title_id' => $episode->id]);
                                            }
                                        }
                                    }
                                    if (isset($episode->credits->crew)) {
                                        foreach($episode->credits->crew as $crew) {
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
                                                        $person->directorOfTitles()->attach($episode->id);
                                                    }
                                                    
                                                    if ($crew->department === "Production") {
                                                        $person->producerOTitles()->attach($episode->id);
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
                        $season_num++;
                    }
                }
            }
        }  
    }  
}
