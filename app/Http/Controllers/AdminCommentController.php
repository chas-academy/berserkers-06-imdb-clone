<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role = 1) {

            $comments = Comment::where('status', '!=', '1')->get();
            foreach ($comments as $comment) {
                $comment->load(['review', 'user']);
                $comment->review->load(['getTitle']);

                if($comment->review->getTitle->type === 'movie') {
                    $comment->review->getTitle->load(['movie']);
                } else if ($comment->getTitle->type === 'series') {
                    $comment->review->getTitle->load(['series']);
                } else if ($comment->getTitle->type === 'episode') {
                    $comment->review->getTitle->load(['episode']);
                }
            }
            
            return view('admin.handlecomments', ['comments' => $comments]);
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
    public function update(Request $request, Comment $comment)
    {

        if (Auth::user()->role === 1) {

            $comment->status = $request->status;
            $comment->save();
            $request->session()->flash('message', ['success' =>'Comment status successfully updated!']);
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