<?php

namespace App\Http\Controllers;

use App\Title;
use App\Movie;
use App\Series;
use App\Episode;
use App\Rating;
use App\Genre;
use App\Photo;
use App\Person;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Traits\DatabaseHelpers;

class TitlesController extends Controller
{
    use DatabaseHelpers;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $allRatings = Rating::all();

        $name = $request->title;
        $type = $request->type;
        $genre = $request->genre;
        $hasGenre = false;

        if (!isset($type)) {

            $type = 'movie';
        }

        if ($type == 'episode') {

            $titleColumn = 'name';

        } else {

            $titleColumn = 'title';
        }
        
        if (isset($genre)) {
            
           $hasGenre = true;
        }

        if (!$hasGenre) {
               
                $titles=  Title::whereHas($type, function($q) use($name,$titleColumn) {
                    $q->where($titleColumn, 'like', '%' . $name .'%' );
                })->get();

        } else {

                $titles =  Title::whereHas($type, function($q) use($name,$titleColumn) {
                    $q->where($titleColumn, 'like', '%' . $name .'%' );
                })->whereHas('genres', function($q) use($genre){
                    $q->where('name',$genre);
                })->get();
        }
      
        foreach ($titles as $title) {
           
            if($title->type == 'movie') {

                $title->load(['directors','photos','actors','genres', 'ratings', 'movie']);

                $ratingSummary = 0;
                $i = 0;

                foreach ($title->ratings as $rating) {
                    $ratingSummary = $ratingSummary + $rating->rating;
                    $i++;
                }

                if ($i != 0) {
                    $ratingSummary = $ratingSummary / $i;
                } 

                $title['rating'] = $ratingSummary;

            } elseif ($title->type == 'series') {

                $seasons = $title->series->seasons;
                $actors = [];

                foreach ($seasons as $season) {
                    foreach($season->episodes as $episode) {
                        foreach($episode->actors as $actor) {

                            $actors = $this->getPersonsWithCount($actor, $actors);
                        }   
                    }
                }

                $actors = $this->sortPersons($actors);
                
                $title['actors'] = $actors;

                $title->load(['creators','photos','genres', 'ratings']);

                $ratingSummary = 0;
                $i = 0;

                foreach ($title->ratings as $rating) {
                    $ratingSummary = $ratingSummary + $rating->rating;
                    $i++;
                }

                if ($i != 0) {
                    $ratingSummary = $ratingSummary / $i;
                } 

                $title['rating'] = $ratingSummary;
                
            } elseif ($title->type == 'episode') {

                $actors = [];

                foreach($title->actors as $actor) {
                    $actors = $this->getPersonsWithCount($actor, $actors);
                }
                
                $actors = $this->sortPersons($actors);

                $season = $title->episode[0]->season;
                $series = $season->series;
                $genres = $series->titles->genres;
                $seriesTitle = $series->title;
                $seasonNumber = $season->season_number;
                $seriesId = $season->series_id;

                $title['season_number'] = $seasonNumber;
                $title['series_id'] = $seriesId;
                $title['series_title'] = $seriesTitle;
                $title['actors'] = $actors;
                $title['genres'] = $genres;
                $title['photos'] = $series->titles->photos;
                $title->load(['directors', 'ratings', 'episode']);

                $ratingSummary = 0;
                $i = 0;
                
                foreach ($title->ratings as $rating) {
                    $ratingSummary = $ratingSummary + $rating->rating;
                    $i++;
                }

                if ($i != 0) {
                    $ratingSummary = $ratingSummary / $i;
                } 

                $title['rating'] = $ratingSummary;

            } 
        }

        $titles = $titles->sortByDesc('rating')->values();
        
        $page = $request->page;
        if (!isset($request->page)) {
            $page = 1;
        }
        $ItemPerPage = 9;
        $start = ($page * $ItemPerPage) -$ItemPerPage;

        $titles = new LengthAwarePaginator(
            array_slice($titles->toArray(),$start,$ItemPerPage,true),
            count($titles),
            $ItemPerPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );
        
        return view('catalog', ['titles' => $titles, 'all_ratings' => $allRatings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (Auth::user()->role == 1) {

            $client = new Client(['base_uri' => 'https://api.themoviedb.org/3/', 'delay' => 251]);

            if(isset($request->name)) {

                $name = $request->name;
                $type = $request->type;

                if($request->type == 'series') {

                    $response = $client->request('GET',"search/tv?api_key=be55d92a645f3fe8c6ca67ff5093076e&query={$name}");
                    $response = json_decode($response->getBody());
                    $titles = $response->results;
        
                } else {
                
                    $response = $client->request('GET',"search/movie?api_key=be55d92a645f3fe8c6ca67ff5093076e&query={$name}");
                    $response = json_decode($response->getBody());
                    $titles = $response->results;
                }

                return view('admin.addtitle', ['titles' => $titles, 'type' => $type]);    
            }

            return view('admin.addtitle');
            }

        return redirect(url()->previous());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if(Auth::user()->role == 1) {

            $titleId = $request->title_id;

            if ($request->type == 'movie') {

                $this->addMovieToDb($titleId);

            } elseif ($request->type == 'series') {

                $this->addSeriesToDb($titleId);

            } 

            return redirect(url()->previous())->with('messege', 'sucess');
        }

        return redirect(url()->previous());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Title  $title
     * @return \Illuminate\Http\Response
     */
    public function show(Title $title)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Title  $title
     * @return \Illuminate\Http\Response
     */
    public function edit(Title $title)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Title  $title
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Title $title)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Title  $title
     * @return \Illuminate\Http\Response
     */
    public function destroy(Title $title)
    {
        //
    }

    public function rate(Request $request, Title $title) 
    {
        $message = $this->attachRating($request, $title->id);
       
        if(isset($message['success'])) {

            return redirect(url()->previous())->with(['success' => $message['success']]);

        } else {

            return redirect(url()->previous())->with(['error' => $message['error']]);
        }
        
    }
}
