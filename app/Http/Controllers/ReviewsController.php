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
    const ITEMCOLUMNS = ['title_id', 'user_id', 'title', 'body', 'created_at', 'updated_at', 'status'];
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
        $reviews = Review::orderByRaw('created_at DESC')->get();

        return view('reviews.index', ['reviews' => $reviews]);
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
            ]);
            
            if ($request->has('rating')) {
                
                $this->attachRating($request, $request->title_id);
            }

            if($review) {
                $title = Title::find($request->input('title_id'));
                if($title->type != 'episode') {    
                    return redirect(url()->previous())->with('success', 'Review successfully created!');; 
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
        if (Auth::user()->role === 1) {
            $id = $review->id;
            $review = Review::find($id);

            try{
                $review->comments()->delete();
                $review->delete();
            } catch(Exception $e) {
                $dd($e);
            }
        
            return redirect('/');  
        }

        return back();
    }
}
