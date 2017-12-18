<?php

namespace App\Http\Controllers;

use App\Episode;
use App\Season;
use App\Series;
use App\Title;
use Illuminate\Http\Request;

class SeasonsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($series_id)
    {
        //
        $series = Series::find($series_id);
        $seasons = Season::where('series_id', '=', $series_id)->get();
        $season_titles = Title::where('type', '=', 'season')->get();

        return view('titles/series/seasons.index', ['series' => $series, 'seasons' => $seasons, 'season_titles' => $season_titles]);
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
     * @param  \App\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function show($series_id, $season_number)
    {
        //
        $series = Series::find($series_id);
        $season = Season::where('series_id', '=', $series_id)->where('season_number', '=', $season_number)->first();
        $episodes = Episode::where('season_id', '=', $season->title_id)->get();
        $season_title = Title::find($season->title_id);

        return view('titles/series/seasons.show', ['series' => $series, 'season' => $season, 'episodes' => $episodes, 'season_title' => $season_title]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function edit(Season $season)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Season $season)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function destroy(Season $season)
    {
        //
    }
}
