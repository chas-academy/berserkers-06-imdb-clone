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
                    $request->session()->flash('message', ['success' =>'Review successfully created!']);
                    return redirect(url()->previous());
                }

            } else {
                $request->session()->flash('message', ['error' =>'Error creating review']);
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
            $request->session()->flash('message', ['success' =>'Review successfully updated!']);
            return back();
        }

        $request->session()->flash('message', ['unauthorised' => 'You are not authorised to perform this action']);
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
            
            $request->session()->flash('message', ['success' =>'Review successfully been deleted!']);
            return redirect('/');  
        }

        $request->session()->flash('message', ['unauthorised' => 'You are not authorised to perform this action']);
        return back();
    }
}
