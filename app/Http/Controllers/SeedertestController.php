<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Person;
use App\Movie;

class SeedertestController extends Controller
{
    public function index () 
    {
        $client = new Client(['base_uri' => 'https://theimdbapi.org/api/']);
        $response = $client->request('GET','movie?movie_id=tt0175880');
        $movie = json_decode($response->getBody());
       
        $moviearray = ['title' => $movie->title, 
        'release_year' => $movie->release_date,
        'plot_summary' => $movie->storyline, 
        'runtime' => (int) $movie->length, 
        'countries' => $movie->metadata->countries[0], 
        'pg_rating' => $movie->content_rating, 
        'trailer' => $movie->trailer];
        $request = [];
        foreach($moviearray as $key => $value) {
            if (isset($value) && $value != null) {
            $request += [$key => $value];
            }
        }
        //Movie::create($request);

        //dd($movie);
        $request = [];
        if (isset($movie->director)) {
            $name = str_replace(' ', '+', $movie->director);
            $person = $client->request('GET', "find/person?name={$name}");
            $person = json_decode($person->getBody());
        
            foreach($person[0] as $key => $value) {
                if (isset($value) && $value != null) {
                    switch ($key) {
                        case 'title':
                            $name = explode('+', $name);
                            $request += ['firstname' => $name[0] . ' ' . $name[1] ];
                            $request += ['lastname' => $name[2]];
                            break;
                        case 'birthday': 
                            $request += ['birthdate' => $value];
                        case 'deathdate':
                            $request += ['deathdate' => $value];
                            break;
                        default:
                            break;
                    } 
                }
            }
            //dd($request);
            Person::create($request);
        }

       
        Person::where('name', '=', $movie->director)->firstOrFail();
        

        //https://theimdbapi.org/api/movie?movie_id=tt0175880

    }
}
