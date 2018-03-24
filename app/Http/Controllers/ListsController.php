<?php

namespace App\Http\Controllers;

use App\UserList;
use App\TitleList;
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
     
      return view('users.userpage', [
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

          $request->session()->flash('message', ['error' =>'The list could not be created']);
          return redirect(url()->previous());
        }

        $request->session()->flash('message', ['success' =>'A list was successfully created']);
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
    public function show(UserList $list)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserList  $list
     * @return \Illuminate\Http\Response
     */
    public function edit(UserList $list)
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

      $orderdList = $list->titleLists->sortBy('list_index')->values()->all();

      $listIndex = $request->list_index;
      
      if (isset($request->title_id)) {
        
        $titleId = $request->title_id;
        
        if (isset($request->old_list_index)) {

          $oldIndex = $request->old_list_index;
          
          if ($listIndex < $oldIndex) {
            
            foreach ($orderdList as $key => $title) {
                
                if ($listIndex == $title->list_index) {
                  
                    for ($i = $key; $i < $oldIndex ; $i++) {

                      $orderdList[$i]->increment('list_index');
                    } 

                    $rowToUpdate = $list->titleLists->where('title_id', '=', $titleId)->first();
                    $rowToUpdate->list_index = $listIndex;
                    $rowToUpdate->save();

                    return redirect(url()->previous());
                } 
            }

          } elseif ($listIndex > $oldIndex) {
            
            foreach ($orderdList as $key => $title) {
              
              if (($oldIndex + 1) == $title->list_index) {
                
                for ($i = $key; $i < $listIndex ; $i++) {
                  
                  $orderdList[$i]->decrement('list_index');
                }

                $rowToUpdate = $list->titleLists->where('title_id', '=', $titleId)->first();
                $rowToUpdate->list_index = $listIndex;
                $rowToUpdate->save();

                $request->session()->flash('message', ['success' =>'The list was successfully updated']);

                return redirect(url()->previous());
              } 
            }        
          }

        } elseif (isset($request->remove)) {
          
          foreach ($orderdList as $key => $title) {
            
            if ($listIndex == $key) {
              
              for ($i = $key; $i < count($orderdList); $i++) {

                $orderdList[$i]->decrement('list_index');
              }
            
            }
          }
          
          $toBeRemoved= TitleList::where([['user_list_id', '=', $list->id],[ 'title_id', '=', $titleId]])->first();
          $toBeRemoved->delete();
          $request->session()->flash('message', ['success' =>'The title was sucessfully removed from the list']);
          return redirect(url()->previous());
          
        } else {

          $listIndex = count($list->titleLists) +1;
          TitleList::insert(['user_list_id' => $list->id, 'title_id' => $titleId, 'list_index' => $listIndex ]);
          
        }
        
        $request->session()->flash('message', ['success' =>'The title was sucessfully added to your list']);
        return redirect(url()->previous());

      } else {
        

        if ($request->type === 'movie') {

          $title = Movie::where('title', $request->name)->first(); 

  
        } elseif ($request->type === 'series'){
          
          $title = Series::where('title', $request->name)->first(); 

        } elseif ($request->type === 'episode'){
          
          $title = Episode::where('name', $request->name)->first(); 
          
        }

        if(isset($title)) {

          $titleId = $title->title_id;
        }
        
      }

      if (isset($titleId)) {
        
        foreach ($orderdList as $key => $title) {
            
            if ($listIndex == $title->list_index) {
              
                for ($i = $key; $i < count($orderdList) ; $i++) {

                  $orderdList[$i]->increment('list_index');
                } 
            } 
        }

        TitleList::insert(['user_list_id' => $list->id, 'title_id' => $titleId, 'list_index' => $listIndex ]);

        $request->session()->flash('message', ['success' =>'The title was sucessfully added to your list']);
        return redirect(url()->previous());

      } else {

        $request->session()->flash('message', ['error' =>'The title could not be added, it was not found in our database']);
        return redirect(url()->previous()); 
      }
      

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserList  $list
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserList $list)
    {

       try {

        TitleList::where('user_list_id','=', $list->id)->delete();
        UserList::where('id', '=',  $list->id)->delete();
 
       } catch (Excepition $e) {

         return redirect(url()->previous())->with('error', $e);
       }
      
       return redirect(url()->previous());
    }
}
