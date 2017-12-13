<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Character;
use App\Person;
use App\Movie;
use App\Genre;
use App\Photo;
use App\Title;

class SeedertestController extends Controller
{
    public function index () 
    {
        $client = new Client(['base_uri' => 'https://theimdbapi.org/api/']);
        $response = $client->request('GET','movie?movie_id=tt0175880');
        $movie = json_decode($response->getBody());
        $title = Title::create(['type' => 'movie']);
        //if (is_null(Movie::where('title', '=', $movie->title)->first())) {
            $movie_array = [
            'title_id' => $title->id,
            'title' => $movie->title, 
            'release_year' => $movie->release_date,
            'plot_summary' => $movie->storyline, 
            'runtime' => (int) $movie->length, 
            'countries' => $movie->metadata->countries[0], 
            'pg_rating' => $movie->content_rating, 
            'trailer' => $movie->trailer];
            $request = [];
            foreach($movie_array as $key => $value) {
                if (isset($value) && $value != null) {
                $request += [$key => $value];
                }
            }
            
           Movie::create($request);

            if (isset($movie->genre)){
                foreach($movie->genre as $api_genre){
                    $genre = Genre::where('name', '=', $api_genre)->first();
                    if(!isset($genre)) {
                        $genre = Genre::create(['name' => $api_genre]);
                    }
                    $title->genres()->attach($genre->id);
                }
            }

            if (isset($movie->poster)){
                foreach($movie->poster as $photo){
                    
                    Photo::create(['title_id' => $title->id, 'photo_path' => $photo]);
                    
                }
            }
            
            $person = Person::where('name', '=', $movie->director)->first();
            if (isset($movie->director) && !isset($person)) {
                $request = [];
                $name = str_replace(' ', '+', $movie->director);
                $person = $client->request('GET', "find/person?name={$name}");
                $person = json_decode($person->getBody());
                foreach($person[0] as $key => $value) {

                    if (isset($value) && $value != null) {    

                        switch ($key) {
                            case 'title':
                                $request += ['name' => $movie->director];
                                break;
                            case 'description':
                                $request += ['bio' => $value];
                                break;
                            case 'birthday': 
                                $request += ['birthdate' => $value];
                                break;
                            case 'deathdate':
                                $request += ['deathdate' => $value];
                                break;
                            default:
                                break;
                        } 
                    }
                }
                $person = Person::create($request);
                
            }

            $person->director_of_title()->attach($title->id);
            
            if (isset($movie->writers)) {
                foreach($movie->writers as $writer_name){
                    
                    $person = Person::where('name', '=', $writer_name)->first();
                    if (!isset($person)) {
                        $name = str_replace(' ', '+', $writer_name);
                        $person = $client->request('GET', "find/person?name={$name}");
                        $person = json_decode($person->getBody());
                        $request = [];
                        foreach($person[0] as $key => $value) {
                            if (isset($value) && $value != null) {
                                switch ($key) {
                                    case 'title':
                                        $request += ['name' => $writer_name];
                                        break;
                                    case 'description':
                                        $request += ['bio' => $value];
                                        break;
                                    case 'birthday': 
                                        $request += ['birthdate' => $value];
                                        break;
                                    case 'deathdate':
                                        $request += ['deathdate' => $value];
                                        break;
                                    default:
                                        break;
                                } 
                            }
                        }

                    $person = Person::create($request);
                    }
                    $person->screenwriter_of_title()->attach($title->id);
                }
            }

            if (isset($movie->cast)) {
                foreach($movie->cast as $cast) {
                    
                    $person = Person::where('name', '=', $cast->name)->first();
                    if (!isset($person)) {

                        $name = str_replace(' ', '+', $cast->name);
                        $person = $client->request('GET', "find/person?name={$name}");
                        $person = json_decode($person->getBody());
                        $request = [];
                        foreach($person[0] as $key => $value) {

                            if (isset($value) && $value != null) {

                                switch ($key) {

                                    case 'title':
                                        $request += ['name' => $cast->name];
                                        break;
                                    case 'description':
                                        $request += ['bio' => $value];
                                        break;
                                    case 'birthday': 
                                        $request += ['birthdate' => $value];
                                        break;
                                    case 'deathdate':
                                        $request += ['deathdate' => $value];
                                        break;
                                    default:
                                        break;
                                } 
                            }
                        }

                        $person = Person::create($request);
                    }

                    $character = Character::where('character_name', '=', $cast->character)->first();

                    if (!isset($character)) {
                    $character = Character::create(['character_name' => $cast->character]);
                    
                    }

                    $person->title_characters()->attach($character->id, ['title_id' => $title->id]);
                   
                }
            }
        //}      
        //https://theimdbapi.org/api/movie?movie_id=tt0175880

    }
}
