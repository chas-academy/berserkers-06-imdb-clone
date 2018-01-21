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
        ini_set('max_execution_time', 3000);
        
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
        
        if (isset($titles[0])) {

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
            
        } else {

            $request->session()->flash('message', ['error' => 'Ther are no titles that matches your query']);

            return view('catalog');
        }
       
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
                
                if (!empty($titles)) {

                
                    $request->session()->flash('message', ['success' =>'Here are your ressults! Please note that series with several seasons can take a while to add']);
                    return view('admin.addtitle', ['titles' => $titles, 'type' => $type]); 
                }

                $request->session()->flash('message', ['error' =>'No title was found. Are you sure you spelled the name correctly?']);

                return view('admin.addtitle');    
            }

            if(session()->has('message')) {

                $request->session()->reflash();

            } else {
                
                $request->session()->flash('message', ['error' =>'Search for a title you would like to add or update']);
            }
            
            return view('admin.addtitle');

            }

        $request->session()->flash('message', ['unauthorised' =>'You are not authorised to acces this page']);

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

                $title = $this->addMovieToDb($titleId);

            } elseif ($request->type == 'series') {

                $title = $this->addSeriesToDb($titleId);

            } 

            if (isset($title)){

                $request->session()->flash('message', ['success' =>'The title was added/updated']);    

            } else {

                $request->session()->flash('message', ['error' =>'The title could not be added']);
            }
            
            return redirect('/titles/create');
        
        }

        $request->session()->flash('message', ['unauthorised' =>'You are not authorised to perform this action']);

        return redirect('/');
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

            $request->session()->flash('message', ['success' =>'Your rating was sucessfully added!']);
            return redirect(url()->previous());

        } else {

            $request->session()->flash('message', ['error' =>'Somthing when wrong, pleas try to register you vote again']);
            return redirect(url()->previous())->with(['error' => $message['error']]);
        }
        
    }
}
