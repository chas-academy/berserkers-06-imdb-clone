<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/userpage';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function checkIfDeactivated(Request $request) 
    {

        $user = User::where('username', '=', $request->username)->first();
        if($user) {
            if ($user->role == 0) {
                $request->session()->flash('message', ['unauthorised' =>'Your userprofile has been deactivated']);
                return redirect('/');
            }  
        } else {
            $request->session()->flash('message', ['unauthorised' =>'The username you entered is not registerd in our database']);
            return redirect('/');
        }
        
        $this->login($request);

        return redirect('/');

    }


    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->flash('message', ['success' => 'You Where Sucessfully Logged out!']);

        return redirect('/');
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);

    }

    protected function credentials(Request $request)
    {
        
        return $request->only($this->username(), 'password');
    }

    protected function username()
    {
        return 'username';
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $request->session()->flash('message', ['error' => 'Incorect Password or Username']);
    }

    protected function sendLoginResponse(Request $request)
    {   
        $request->session()->regenerate();
       
        $request->session()->flash('message', ['success' => 'You Where Sucessfully Logged In!']);
        
        $this->clearLoginAttempts($request);
        return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath());
    }

}
