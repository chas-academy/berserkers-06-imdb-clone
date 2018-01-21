<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        
        if(Auth::user()->id == $user->id) {
            
            return view('users.settings',['user' => $user]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {   
        
        $request->validate([
            'firstname' => 'required|max:191',
            'surname' => 'required|max:191',
            'username' => 'required|max:255',
            'email' => 'required|max:191'
        ]);

        $existingUser = User::where('username', '=', $request->username)->first();
    

        if (!isset($existingUser->id) || $existingUser->id == $user->id) {
            
            $existingUser = User::where('email', '=', $request->email)->first();

            if(!isset($existingUser->id) || $existingUser->id == $user->id){

                try {
                    
                    $user->firstname = $request->firstname;
                    $user->surname = $request->surname;
                    $user->username = $request->username;
                    $user->email = $request->email;
                    $user->save();
        
                } catch (Exception $e) {
                    
                    $request->session()->flash('message', ['error' =>'Error updating profile']);
                    return redirect("/users/$user->id/edit");
                }

            }

            $request->session()->flash('message', ['success' =>'Your profile information was sucessfully updated!']);
            return redirect("/users/$user->id/edit");
        }

        $request->session()->flash('message', ['error' =>'The username you selected is not availible']);
        return redirect("/users/$user->id/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
