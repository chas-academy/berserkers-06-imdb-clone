<?php

namespace App\Traits;

use App\Character;
use App\Episode;
use App\Person;
use App\Season;
use App\Series;
use App\Movie;
use App\Title;
use App\Genre;
use App\Photo;
use GuzzleHttp\Client;

trait DatabaseHelpers 
{

  protected function formatForEditing($items) {
    
    $collection = "";

    foreach($items as $key => $item) {

      if (isset($items[0]->photo_path)) {
  
          $collection .= 'photo_path: ' . $item->photo_path . ' | photo_type: ' . $item->photo_type . ' | width: ' . $item->width . ' | ratio: ' . $item->ratio;
          
          if(isset($items[$key +1] )) {

              $collection .= "\n";
          }

        } elseif (isset($items[0]->actor)) {

          foreach($item->actor as $key => $actor) {
              
            if($key === 0) {
              $collection .= $actor->name . ' As ' . $item->character_name;

              if(isset($items[$key +1] )) {
                  
                $collection .=  "\n";
              }
            }
          }

        } else {

            $collection .= $item->name;

            if(isset($items[$key +1] )) {
                
                $collection .= "\n";
            } 
        }
    }

    return $collection;
  }

  protected function updateItem($request, $item) {
    
    $id = $item->title_id;
    $title = Title::find($id);

    foreach(self::PIVOTTABLES as $pivot) {
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

          return; 

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
        
        return; 

        } else {

          $names = explode("\r\n",$request->get($pivot));
          $pivotIds = [];

          foreach ($names as $name) {
            if(strlen($name) != 0) {
              
              if ($pivot === 'genres') {
                
                  $table = Genre::firstOrCreate(['name' => $name]);
                  array_push($pivotIds, $table->id);
    
                } else {
    
                  $table = Person::firstOrCreate(['name' => $name]);
                  
                  array_push($pivotIds, $table->id);
                }
              }
            }
          $title->$pivot()->sync($pivotIds);

          return; 
        }
      }
    }
    
    foreach(self::ITEMCOLUMNS as $column) {

      if ($request->has($column)) {

          $item->$column = $request->get($column);
          $item->save();
          
          return;         
      } 
    }
  }    

  protected function detachAllFromItemAndDelete($item, $type, $id) {
    
    try {

        $item->directors()->detach();
        $item->producers()->detach();
        $item->screenwriters()->detach();
        $item->creators()->detach();
        $item->genres()->detach();
        $item->actors()->detach();
        $item->ratings()->detach();

        foreach($item->reviews as $review) {
            $review->comments()->delete();
        }

        $item->reviews()->delete();
        $item->lists()->detach();
        $item->ratings()->detach();
        $type::where('title_id', '=', $id)->delete();
        Photo::where('imageable_id' ,'=' , $id)->delete();
        Title::where('id', '=', $id)->delete();

    } catch (Exceptions $e) {

        return $e;
    }

    return;
  }

  protected function updateNumOfEpisodesAndSeasonsColumns($series)
  {
    $allSeasons = Season::where('series_id', '=', $series->title_id)->get();
    $allSeasonsIds = [];
    
    foreach($allSeasons as $season) {
        array_push($allSeasonsIds, $season->title_id);
    }
    
    $allEpisodes = Episode::whereIn('season_id', $allSeasonsIds)->get()->count();
    
    $series->update(['num_of_seasons' => $allSeasons->count(),'num_of_episodes' => $allEpisodes]);
  }

  protected function inArrayR($value, $array) 
  {
      foreach($array as $key => $subArray) {
          if (in_array($value, $subArray))
              return $key;
      }

      return null;
  }

  protected function getPersonsWithCount($actor, $array) 
  {
      
      $key = $this->inArrayR($actor->name,$array);
          
      if (!isset($key)) {
          array_push($array,['name' => $actor->name, 'count' => 1, 'id' => $actor->id]);
      } else {
          
          $array[$key]['count']++;
      }

      return $array;

  }

  protected function sortPersons($persons)
  {
      usort($persons, function($a, $b) {
          return $b['count'] <=> $a['count'];
      });

      return $persons;
  }

    protected function addMovieToDb($titleId) 
    {
        $client = new Client(['base_uri' => 'https://api.themoviedb.org/3/', 'delay' => 251]);
        $omdbClient = new Client(['base_uri' => 'http://www.omdbapi.com/', 'delay' => 251]);

        $response = $client->request('GET',"movie/{$titleId}?api_key=be55d92a645f3fe8c6ca67ff5093076e&append_to_response=credits,videos");
        $movie = json_decode($response->getBody());
        
        if (is_null(Movie::where([['title', '=', $movie->title],['release_year', '=', $movie->release_date]])->first())) {
            
            $response = $omdbClient->request('GET',"?t={$movie->title}&apikey=c73f9c20");
            $response = json_decode($response->getBody());

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

                    $countries .= $result->iso_3166_1 . ', ';
                }

                $countries = substr($countries, 0 , (strlen($countries) -2 ));
                
                $movieArray += ['countries' => $countries];
            }

            if (isset($movie->videos->results[0])) {

                $movieArray += ['trailer' => "https://www.youtube.com/embed/{$movie->videos->results[0]->key}"];
            }

            if (isset($response->Rated)) {
                $movieArray += ['pg_rating' => $response->Rated];  
            }

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
        return;
    }

    protected function addSeriesToDb($seriesId) 
    {
        $client = new Client(['base_uri' => 'https://api.themoviedb.org/3/', 'delay' => 251]);
        
        $response = $client->request('GET',"tv/{$seriesId}?api_key=be55d92a645f3fe8c6ca67ff5093076e&append_to_response=external_ids,content_ratings,videos,credits");
        $series = json_decode($response->getBody());
        $existingSeries = Series::where([['title', '=', $series->name],['countries', '=',$series->origin_country[0]],['release_year', '=', $series->first_air_date]])->first();
        
        if (is_null($existingSeries)) {
            
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

        
      } elseif ($series->number_of_seasons > $existingSeries->num_of_seasons) {

            $seasonNumber = $existingSeries->num_of_seasons;

            foreach($series->seasons as $key => $season) {

                if (($key >= $seasonNumber && $series->seasons[0]->season_number != 0 ) || ($key > $seasonNumber && $series_seasons[0]->season_number == 0)) {

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

            $this->updateNumOfEpisodesAndSeasonsColumns($existingSeries);

        } elseif ($series->number_of_episodes > $existingSeries->num_of_episodes) {
          
            $seasonNumber = $existingSeries->num_of_seasons;
            
            foreach($series->seasons as $key => $season) {
              
                if ( ($seasonNumber -1 == $key && $series->seasons[0]->season_number != 0 ) || ($series->seasons[0]->season_number == 0 && $seasonNumber == $key) ) {
                  
                    $seasonTitle = $existingSeries->seasons[$seasonNumber-1];
                    
                    for($episodeNumber = count($seasonTitle->episodes)+1; $episodeNumber <= $season->episode_count; $episodeNumber++) {
                      
                        $response = $client->request('GET',"tv/{$seriesId}/season/{$seasonNumber}/episode/{$episodeNumber}?api_key=be55d92a645f3fe8c6ca67ff5093076e&append_to_response=credits");
                        $dbEpisode = json_decode($response->getBody());
                        
                        if (is_null(Episode::where([['name', '=', $dbEpisode->name], ['season_id', '=', $seasonTitle->title_id]])->first())) {
                            
                            $episode = Title::create(['type' => 'episode']);
                        
                            $episodeArray = [
                            'title_id' => $episode->id,
                            'season_id' => $seasonTitle->title_id,
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

            }

            $this->updateNumOfEpisodesAndSeasonsColumns($existingSeries);
        }
        return;
    }

}