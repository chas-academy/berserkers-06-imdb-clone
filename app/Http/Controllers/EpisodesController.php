<?php

namespace App\Http\Controllers;

use App\Episode;
use App\Season;
use App\Series;
use App\Title;
use Illuminate\Http\Request;
use App\Traits\DatabaseHelpers;

class EpisodesController extends Controller
{

    const ITEMCOLUMNS = ['name', 'episode_number', 'plot_summary', 'end_date', 'air_date'];
    const PIVOTTABLES = ['photos', 'actorsAsCharacters', 'directors', 'producers', 'screenwriters' ];

    use DatabaseHelpers;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($series_id, $season_number)
    {
        //
        $series = Series::find($series_id);
        $season = Season::where('series_id', '=', $series_id)->where('season_number', '=', $season_number)->first();
        $episodes = Episode::where('season_id', '=', $season->title_id)->get();
        $episode_titles = Title::where('type', '=', 'episode')->get();

        return view('titles/series/seasons/episodes.index', ['series' => $series, 'season' => $season, 'episodes' => $episodes, 'episode_titles' => $episode_titles]);
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
     * @param  \App\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function show($series_id, $season_number, $episode_number)
    {
        //
        $series = Series::find($series_id);
        $season = Season::where('series_id', '=', $series_id)->where('season_number', '=', $season_number)->first();
        $episode = Episode::where('season_id', '=', $season->title_id)->where('episode_number', '=', $episode_number)->first();
        $episode_titles = Title::where('type', '=', 'episode')->get();

        return view('titles/series/seasons/episodes.show', ['series' => $series, 'season' => $season, 'episode' => $episode, 'episode_titles' => $episode_titles]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Episode $episode)
    {
        $id = null;

        if (isset($request->title_id)) {
            $id = $request->title_id;
        } else {
            $id = session('title_id');
        }
        
        $episode = Episode::find($id);
        $title = Title::find($id);
        
        $season = Season::find($episode->season_id);
        $series = Series::find($season->series_id);
        $directors = $this->formatForEditing($title->directors);
        $producers = $this->formatForEditing($title->producers);
        $screenwriters = $this->formatForEditing($title->screenwriters);
        $actorsAsCharacters = $this->formatForEditing($title->characters);
        $photos = $this->formatForEditing($title->photos);

        session(['title_id' => $id]);

        return view('titles.series.seasons.episodes.edit', [
            'episode' => $episode, 
            'season' => $season,
            'series' => $series, 
            'directors' => $directors, 
            'producers' => $producers, 
            'screenwriters' => $screenwriters,
            'actorsAsCharacters' => $actorsAsCharacters,
            'photos' => $photos
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Episode $episode)
    {
        $id = $request->title_id;
        $episode = Episode::find($id);

        $this->updateItem($request, $episode);
        
        $path = $request->path();

        return redirect("$path/edit")->with('title_id', $episode->title_id); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Episode $episode)
    {
        $episodeId = $request->title_id;
        $episode = Episode::find($episodeId);
        $episodeTitle = Title::find($episodeId);
        $season= Season::where('title_id', '=', $episode->season_id)->get();
        $seriesId = $season[0]->series_id;
        $series = Series::find($seriesId);

        try {
       
            $this->detachAllFromItemAndDelete($episodeTitle, Episode::class, $episodeId);

            $this->updateNumOfEpisodesAndSeasonsColumns($series);
    
        } catch(Exception $e) {

            return $e;
        }

        $seasonNumber = $season[0]->season_number;

        return redirect("/titles/series/$seriesId/seasons/$seasonNumber");  
    }
}
