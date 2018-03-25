<?php

namespace App\Http\Controllers;

use App\Episode;
use App\Season;
use App\Series;
use App\Title;
use Illuminate\Http\Request;
use App\Traits\DatabaseHelpers;
use Illuminate\Support\Facades\Auth;

class EpisodesController extends Controller
{

    const ITEMCOLUMNS = ['name', 'episode_number', 'plot_summary', 'end_date', 'air_date'];
    const PIVOTTABLES = ['photo', 'actorsAsCharacters', 'directors', 'producers', 'screenwriters' ];

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
        
        $series = Series::find($request->series_id);
        $season = $series->seasons->where('season_number', '=', $request->season_number)->first();
        $episode = $season->episodes->where('episode_number', '=', $request->episode_number)->first();
        
        $title = Title::find($episode->title_id);

        if (Auth::user()->role === 1) {   
           
            $directors = $this->formatForEditing($title->directors);
            $screenwriters = $this->formatForEditing($title->screenwriters);
            $actorsAsCharacters = $this->formatForEditing($title->characters);
            $photos = $title->photos;
            
            return view('titles.series.seasons.episodes.edit', [
                'episode' => $episode, 
                'season' => $season,
                'series' => $series, 
                'directors' => $directors, 
                'screenwriters' => $screenwriters,
                'actorsAsCharacters' => $actorsAsCharacters,
                'photos' => $photos
                ]);
        }

        $request->session()->flash('message', ['unauthorised' => 'You are not authorised visit this page']);

        return redirect("/titles/series/{$series->title_id}/seasons/{$season->season_number}/episodes/{$episode->episode_number}");
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
        $path = $request->path();

        if (Auth::user()->role === 1) {
            $id = $request->title_id;
            $episode = Episode::find($id);

            if($request->photo_id) {
                $request["photo"] = [
                    "id" => (int) $request->photo_id
                ];
            } else if($request->photo_path) {
                $request["photo"] = [
                  
                ];
            }

            $this->updateItem($request, $episode);

            $request->session()->flash('message', ['success' =>'the episode was successfully updated!']);

            return redirect("$path/edit")->with('title_id', $episode->title_id); 
        }

        $request->session()->flash('message', ['unauthorised' => 'You are not authorised to perform this action']);

        return redirect("$path");
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Episode $episode)
    {
        if (Auth::user()->role === 1) {
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

            $request->session()->flash('message', ['success' =>'The episode was successfully removed']);

            return redirect("/titles/series/$seriesId/seasons/$seasonNumber");  
        }

        $request->session()->flash('message', ['unauthorised' => 'You are not authorised to perform this action']);
        return redirect("/");  
    }
}
