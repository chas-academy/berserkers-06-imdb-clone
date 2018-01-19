<?php

namespace App\Http\Controllers;

use App\Review;
use App\Title;
use App\Movie;
use App\Series;
use Illuminate\Http\Request;
use App\Traits\DatabaseHelpers;
use Auth;

class ReviewsController extends Controller
{
    const ITEMCOLUMNS = ['title_id', 'user_id', 'title', 'body', 'stars', 'created_at', 'updated_at', 'status'];
    const PIVOTTABLES = ['titles', 'comments', 'users'];
    use DatabaseHelpers;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        if(Auth::check()) {
            $review = Review::create([
                'title_id' => $request->input('title_id'),
                'user_id' => $request->user()->id,
                'title' => $request->input('title'),
                'body' => $request->input('body'),
                'stars' => $request->input('stars')
            ]);
            
            if($review) {
                $title = Title::find($request->input('title_id'));
                switch($title->type) {
                    case 'movie':
                        return redirect()->route('titleMovie', $request->input('title_id'));
                    case 'series':
                        return redirect()->route('titleSeries', $request->input('title_id'));
                }
            } else {
                return back()->withInput()->with('error', 'Error creating review');
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
        $review = Review::find($review->id);
        return view('reviews.edit', ['review' => $review]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
        if (Auth::user()->role === 1) {
            $this->updateItem($request, $review);
            return back();
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
    }
}
