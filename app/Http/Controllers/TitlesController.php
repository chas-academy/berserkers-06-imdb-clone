<?php

namespace App\Http\Controllers;

use App\Title;
use App\Movie;
use App\Series;
use App\Episode;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;


class TitlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $q = $request->title;
        $titlesIds = [];
        if(!isset($q)) {

            $movies = Movie::all();
            $series = Series::all();
            $episodes = Episode::all();

            $titles = $movies->merge($series);

            $titles = $titles->merge($episodes);

            foreach($titles as $title) {
                array_push($titlesIds,$title->title_id);
            }

        }  else {

            $movies = Movie::where('title', 'like', '%' . $q .'%' )->get();
            $series = Series::where('title', 'like', '%' . $q .'%' )->get();
            $episodes = Episode::where('name', 'like', '%' . $q .'%' )->get();

            $titles = $movies->merge($series);
            
            $titles = $titles->merge($episodes);

            foreach($titles as $title) {
                array_push($titlesIds,$title->title_id);
            }

        }

        $titles = Title::whereIn('id', $titlesIds)->get();
      
        foreach ($titles as $title) {

                
                if($title->type == 'movie') {
                    $title->load(['directors','photos','actors','genres', 'ratings', 'movie']);
                } elseif ($title->type == 'series') {
                    $title->load(['creators','photos','genres', 'ratings', 'series']);
                } elseif ($title->type == 'episode') {
                    $title->load(['directors','photos','genres', 'ratings', 'episode']);
                }
               
            
        }
        
        $page = $request->page || 1;
        $ItemPerPage = 12;
        $start = ($page * $ItemPerPage) -$ItemPerPage;

        $titles = new LengthAwarePaginator(
            array_slice($titles->toArray(),$start,$ItemPerPage,true),
            count($titles),
            $ItemPerPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );
        // dd($titles->items()[0]['actors'][0]['name']);
        return view('catalog', ['titles' => $titles]);
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
}
