<?php

namespace App\Http\Controllers;

use App\User;
use App\Comment;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role = 1) {

            $reviews = Review::where('status', '!=', '1')->get();
            foreach ($reviews as $review) {
                $review->load(['getTitle', 'user']);

                if($review->getTitle->type === 'movie') {
                    $review->getTitle->load(['movie']);
                } else if ($review->getTitle->type === 'series') {
                    $review->getTitle->load(['series']);
                } else if ($review->getTitle->type === 'episode') {
                    $review->getTitle->load(['episode']);
                }
            }

            return view('admin.handlereviews', ['reviews' => $reviews]);
        }

        $request->session()->flash('message', ['unauthorised' => 'You are not authorised to acces this page']);
        return redirect('/');
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {

        if (Auth::user()->role === 1) {

            $review->status = $request->status;
            $review->save();
            $request->session()->flash('message', ['success' =>'Review status successfully updated!']);
            return back();
        }

        $request->session()->flash('message', ['unauthorised' => 'You are not authorised to perform this action']);
        return redirect('/');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

    }
}