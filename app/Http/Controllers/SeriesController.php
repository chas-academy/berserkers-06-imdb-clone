<?php

namespace App\Http\Controllers;

use App\Episode;
use App\Season;
use App\Series;
use App\Title;
use Illuminate\Http\Request;
use App\Traits\DatabaseHelpers;
use Illuminate\Support\Facades\Auth;
class SeriesController extends Controller
{
   
    const ITEMCOLUMNS = ['title', 'release_year', 'plot_summary', 'end_date', 'countries', 'pg_rating', 'trailer'];
    const PIVOTTABLES = ['genres', 'photos', 'creators' ];

    use DatabaseHelpers;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $series = Series::all();
        $titles = Title::where('type', '=', 'series')->get();

        return view('titles/series.index', ['series' => $series, 'titles' => $titles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Series  $series
     * @return \Illuminate\Http\Response
     */
    public function show(Series $series)
    {
        //
        $id = $series->title_id;
        $seasons = $series->seasons;
        $title = $series->titles;

        $actors = [];
        $producers = [];
        $directors = [];
        $screenwriters = [];
        foreach ($seasons as $season) {
            foreach($season->episodes as $episode) {
                foreach($episode->actors as $actor) {

                    $actors = $this->getPersonsWithCount($actor, $actors);
                }   
                foreach($episode->producers as $producer) {

                    $producers = $this->getPersonsWithCount($producer, $producers);
                }
                foreach($episode->directors as $director) {

                    $directors = $this->getPersonsWithCount($director, $directors);
                }
                foreach($episode->screenwriters as $screenwriter) {

                    $screenwriters = $this->getPersonsWithCount($screenwriter, $screenwriters);
                }
            }
        }

        $actors = $this->sortPersons($actors);
        $screenwriters = $this->sortPersons($screenwriters);
        $producers = $this->sortPersons($producers);
        $directors = $this->sortPersons($directors);
        
        return view('titles/series.show', [
            'series' => $series, 
            'seasons' => $seasons, 
            'title' => $title, 
            'id' => $id, 
            'actors' => $actors, 
            'screenwriters' => $screenwriters,
            'producers' => $producers,
            'directors' => $directors
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Series  $series
     * @return \Illuminate\Http\Response
     */
    public function edit(Series $series)
    {
        if (Auth::user()->role === 1) {
                
            $id = $series->title_id;
            $series = Series::find($id);
            $title = Title::find($id);
            $genres = $this->formatForEditing($title->genres);
            $creators = $this->formatForEditing($title->creators);
            $photos = $this->formatForEditing($title->photos);

            session(['title_id' => $id]);

            return view('titles/series.edit', [
                'series' => $series, 
                'title' => $title, 
                'genres' => $genres, 
                'creators' => $creators,
                'photos' => $photos
                ]);
        }

        return redirect("/titles/series/{$series->title_id}");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Series  $series
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Series $series)
    {
        if (Auth::user()->role === 1) {

        $this->updateItem($request, $series);

        $path = $request->path();

        $request->session()->flash('message', ['success' =>'The series was successfully updated']);
        return redirect("$path/edit"); 

        }

        return redirect("/");


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Series  $series
     * @return \Illuminate\Http\Response
     */
    public function destroy(Series $series)
    {
        if (Auth::user()->role === 1) {
            $seriesId = $series->title_id;
            $seriesTitle = Title::find($seriesId);
            $seasons = Season::where('series_id', '=', $seriesId)->get();

            try {
                foreach($seasons as $season) {

                    $seasonId = $season->title_id;
                    $seasonTitle = Title::find($seasonId);
                    $episodes = Episode::where('season_id', '=', $seasonId)->get();

                    foreach($episodes as $episode) {
                        $episodeId = $episode->title_id;
                        $episodeTitle = Title::find($episodeId);

                        $this->detachAllFromItemAndDelete($episodeTitle, Episode::class, $episodeId);
                    }

                    $this->detachAllFromItemAndDelete($seasonTitle, Season::class, $seasonId);
                }

                $this->detachAllFromItemAndDelete($seriesTitle, Series::class, $seriesId);
            } catch(Exception $e) {

                return $e;
            }

            $request->session()->flash('message', ['success' =>'The series was successfully deleted']);
            return redirect("/catalog?type=series");  
        }
        
        $request->session()->flash('message', ['unauthorised' => 'You are not authorised to perform this action']);
        return redirect("/"); 
    }

    
}
