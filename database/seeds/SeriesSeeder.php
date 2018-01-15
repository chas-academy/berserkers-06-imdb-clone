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

class SeriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ini_set('max_execution_time', 3000);

        $seriesNames= [
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

        $client = new Client(['base_uri' => 'https://api.themoviedb.org/3/', 'delay' => 251]);

        foreach($seriesNames as $seriesName) {

            $response = $client->request('GET',"search/tv?api_key=be55d92a645f3fe8c6ca67ff5093076e&query={$seriesName}");
            $response = json_decode($response->getBody());
            $seriesId = $response->results[0]->id; 
            
            $response = $client->request('GET',"tv/{$seriesId}?api_key=be55d92a645f3fe8c6ca67ff5093076e&append_to_response=external_ids,content_ratings,videos,credits");
            $series = json_decode($response->getBody());
     
            if (is_null(Series::where([['title', '=', $series->name],['countries', '=',$series->origin_country[0]]])->first())) {
                
                $title = Title::create(['type' => 'series']);

                $seriesArray = [
                'title_id' => $title->id,
                'title' => $series->name, 
                'release_year' => $series->first_air_date,
                'plot_summary' => $series->overview, 
                'countries' => $series->origin_country[0], 
                'num_of_seasons' => $series->number_of_seasons,
                'num_of_episodes' => $series->number_of_episodes
                ];

                if (isset($series->videos->results[0])) {

                    $seriesArray += ['trailer' => "https://www.youtube.com/embed/{$series->videos->results[0]->key}"];
                }

                if ($series->status !== "Returning Series" ) {

                    $seriesArray += ['end_date' => $series->last_air_date];
                }

                if (isset($series->content_ratings->results[0] )) {

                    foreach($series->content_ratings->results as $result) {

                        if ($result->iso_3166_1 === "US") {

                            $seriesArray += ['pg_rating' => $result->rating];
                        }
                    }  
                }

                $request = [];

                foreach($seriesArray as $key => $value) {

                    if (isset($value) && $value != null) {

                        $request += [$key => $value];
                    }
                }
               
                Series::create($request);

                if (isset($series->genres)){

                    foreach($series->genres as $apiGenre){

                        $genre = Genre::where('name', '=', $apiGenre->name)->first();

                        if(!isset($genre)) {

                            $genre = Genre::create(['name' => $apiGenre->name]);
                        }

                        $title->genres()->attach($genre->id);
                    }
                }

                $imgSizes = ["45", "92", "154","185","300","342","500","632", "780","1280"];

                if (isset($series->poster_path)){

                    foreach($imgSizes as $size) {

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
                    
                    foreach($imgSizes as $size) {

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

                if (isset($series->created_by)) {

                    foreach($series->created_by as $creator) {

                        $person = Person::where('name', '=', $creator->name)->first();

                        if (!isset($person)) {

                            $name = str_replace(' ', '+', $creator->name);
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

                    $seasonNumber = $series->seasons[0]->season_number;

                    foreach($series->seasons as $season) {

                        if ($seasonNumber != 0) {

                            $seasonTitle = Title::create(['type' => 'season']);
                            Season::create(['title_id' => $seasonTitle->id, 'series_id' => $title->id, 'season_number' => $seasonNumber]);
                            
                            for($episodeNumber = 1; $episodeNumber <= $season->episode_count; $episodeNumber++) {
                                
                                $response = $client->request('GET',"tv/{$seriesId}/season/{$seasonNumber}/episode/{$episodeNumber}?api_key=be55d92a645f3fe8c6ca67ff5093076e&append_to_response=credits");
                                $dbEpisode = json_decode($response->getBody());
                                
                                if (is_null(Episode::where([['name', '=', $dbEpisode->name], ['season_id', '=', $seasonTitle->id]])->first())) {
                                    
                                    $episode = Title::create(['type' => 'episode']);
                                
                                    $episodeArray = [
                                    'title_id' => $episode->id,
                                    'season_id' => $seasonTitle->id,
                                    'name' => $dbEpisode->name, 
                                    'episode_number' => $episodeNumber,
                                    'plot_summary' => $dbEpisode->overview,
                                    'air_date' => $dbEpisode->air_date,
                                    ];

                                    $request = [];
                                    
                                    foreach($episodeArray as $key => $value) {

                                        if (isset($value) && $value != null) {

                                            $request += [$key => $value];
                                        }
                                    }
                                
                                    Episode::create($request);

                                    if (isset($dbEpisode->images->stills)) {

                                        foreach($dbEpisode->images->stills as $still) {

                                            foreach($imgSizes as $size) {

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

                                    if (isset($dbEpisode->credits)) {

                                        if (isset($dbEpisode->credits->cast)) {

                                            foreach($dbEpisode->credits->cast as $cast) {

                                                $person = Person::where('name', '=', $cast->name)->first();

                                                if (!isset($person)) {
                            
                                                    $name = str_replace(' ', '+', $cast->name);
                                                    
                                                    $request = $client->request('GET', "search/person?api_key=be55d92a645f3fe8c6ca67ff5093076e&query={$name}");
                                                    $request = json_decode($request->getBody());
                                                    
                                                    if (isset($request->results[0])) {

                                                        $personId = $request->results[0]->id;
                                                        
                                                        $response = $client->request('GET', "person/{$personId}?api_key=be55d92a645f3fe8c6ca67ff5093076e&append_to_response=images");
                                                       
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
                                
                                                    $person->characters()->attach($character->id, ['title_id' => $episode->id]);
                                                }
                                            }
                                        }

                                        if (isset($dbEpisode->credits->guest_stars)) {

                                            foreach($dbEpisode->credits->guest_stars as $guestStars) {

                                                $person = Person::where('name', '=', $guestStars->name)->first();

                                                if (!isset($person)) {
                            
                                                    $name = str_replace(' ', '+', $guestStars->name);
                                                    
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
                    
                                                        if (isset($person->birthday) && strlen($person->birthday) === 10) {

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

                                                    $character = Character::where('character_name', '=', $guestStars->character)->first();
                                                    
                                                    if (!isset($character)) {

                                                    $character = Character::create(['character_name' => $guestStars->character]);
                                                    }
                                
                                                    $person->characters()->attach($character->id, ['title_id' => $episode->id]);
                                                }                                            
                                            }
                                        }

                                        if (isset($dbEpisode->credits->crew)) {

                                            foreach($dbEpisode->credits->crew as $crew) {

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

                        $seasonNumber++;
                    }
                }
            }
        }  
    }
}
