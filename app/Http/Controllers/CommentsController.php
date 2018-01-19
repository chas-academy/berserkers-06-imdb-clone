<?php

namespace App\Http\Controllers;

use App\Title;
use App\Comment;
use Auth;
use Illuminate\Http\Request;
use App\Traits\DatabaseHelpers;

class CommentsController extends Controller
{
    const ITEMCOLUMNS = ['review_id', 'user_id', 'body', 'created_at', 'updated_at', 'status'];
    const PIVOTTABLES = ['reviews', 'users'];
    use DatabaseHelpers;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($review_id)
    {
        //
        $comments = Comment::where('review_id', '=', $review_id)->orderByRaw('created_at DESC')->get();

        return view('reviews/comments.index', ['comments' => $comments]);
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
            $comment = Comment::create([
                'review_id' => $request->input('review_id'),
                'user_id' => $request->user()->id,
                'body' => $request->input('body'),
            ]);
            
            if($comment) {
                $title = Title::find($request->input('title_id'));
                switch($title->type) {
                    case 'movie':
                        return redirect()->route('titleMovie', $request->input('title_id'));
                    case 'series':
                        return redirect()->route('titleSeries', $request->input('title_id'));
                }
            } else {
                return back()->withInput()->with('error', 'Error creating comment');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
        if (Auth::user()->role === 1) {
            $this->updateItem($request, $comment);
            return back();
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
        if (Auth::user()->role === 1) {
            $id = $comment->id;
            $comment = Comment::find($id);

            try{
                $comment->delete();
            } catch(Exception $e) {
                $dd($e);
            }
        
            return back();  
        }

        return back();
    }
}
