<?php

namespace App\Http\Controllers;

use App\Userlist;
use App\User;
use App\Title;
use App\Movie;
use App\Series;
use App\Episode;
use Illuminate\Http\Request;
use App\Traits\DatabaseHelpers;
use Illuminate\Support\Facades\Auth;

class ListsController extends Controller
{
   
    use DatabaseHelpers;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $lists = $user->lists;


      return view('users.lists', [
        'lists' => $lists, 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        try {

          UserList::create([
            'name' => $request->name,
            'user_id' => $request->user()->id
          ]);

        } catch (Exception $e) {

          return redirect(url()->previous())->with('error', $e);
        }

        return redirect(url()->previous());
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
     * @param  \App\Userlist  $list
     * @return \Illuminate\Http\Response
     */
    public function show(Userlist $list)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserList  $list
     * @return \Illuminate\Http\Response
     */
    public function edit(Userlist $list)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserList  $list
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserList $list)
    { 

      if (isset($request->title_id)) {

        $title_id = $request->title_id;

      } else {


        if ($request->type === 'movie') {

          $title = Movie::where('title', $request->name)->first(); 

  
        } elseif ($request->type === 'series'){
  
          $title = Series::where('title', $request->name)->first(); 
  
        } elseif ($request->type === 'episode'){
          
          $title = Episode::where('name', $request->name)->first(); 
          
        }

        if(isset($title)) {
          $title_id = $title->title_id;
        }
        
      }

      if (isset($title_id)) {
        
        $list->titles()->toggle($title_id);

      } else {

        return redirect(url()->previous())->with('error', 'Title not found in database');  
      }
      
      return redirect(url()->previous());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserList  $list
     * @return \Illuminate\Http\Response
     */
    public function destroy(Userlist $list)
    {

       try {

        $list->titles()->detach();

        UserList::where('id', '=',  $list->id)->delete();
 
       } catch (Excepition $e) {

         return redirect(url()->previous())->with('error', $e);
       }
      
       return redirect(url()->previous());
    }
}
