<?php

namespace App\Http\Controllers;

use App\Episode;
use App\Season;
use App\Series;
use App\Title;
use Illuminate\Http\Request;

class EpisodesController extends Controller
{
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
    public function edit(Episode $episode)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function destroy(Episode $episode)
    {
        //
    }
}
