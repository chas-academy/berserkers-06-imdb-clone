<?php

namespace App\Http\Controllers;

use App\Episode;
use App\Season;
use App\Series;
use App\Title;
use Illuminate\Http\Request;
use App\Traits\DatabaseHelpers;

class SeriesController extends Controller
{
    const TYPENAME = 'series';
    const ITEMCOLUMNS = ['title', 'release_year', 'plot_summary', 'end_date', 'countries', 'pg_rating', 'trailer'];
    const PIVOTTABLES = ['genres', 'directors', 'producers', 'screenwriters','actorsAsCharacters', 'photos', 'creators' ];

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
        $series = Series::find($id);
        $seasons = Season::where('series_id', '=', $id)->get();
        $title = Title::find($id);

        session(['title_id' => $id]);

        return view('titles/series.show', ['series' => $series, 'seasons' => $seasons, 'title' => $title, 'id' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Series  $series
     * @return \Illuminate\Http\Response
     */
    public function edit(Series $series)
    {
        $id = $series->title_id;
        $series = Series::find($id);
        $title = Title::find($id);
        $genres = $this->formatForEditing($title->genres);
        $creators = $this->formatForEditing($title->creators);
        $directors = $this->formatForEditing($title->directors);
        $producers = $this->formatForEditing($title->producers);
        $screenwriters = $this->formatForEditing($title->screenwriters);
        $actorsAsCharacters = $this->formatForEditing($title->characters);
        $photos = $this->formatForEditing($title->photos);

        session(['title_id' => $id]);

        return view('titles/series.edit', [
            'series' => $series, 
            'title' => $title, 
            'genres' => $genres, 
            'creators' => $creators,
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
     * @param  \App\Series  $series
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Series $series)
    {
        $this->updateItem($request, $series);

        $path = $this->getRedirectPath($series->title_id);

        return redirect("$path/edit"); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Series  $series
     * @return \Illuminate\Http\Response
     */
    public function destroy(Series $series)
    {
        //
    }
}
