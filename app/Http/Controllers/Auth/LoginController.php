<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
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

    protected function authenticated(Request $request, $user)
{
if ( $user->user_type===2 ) {// do your magic here
    return redirect('/admin');
}

 return redirect('/');
}


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    
    protected $redirectTo = '/';
//     protected function redirectTo(){
//         if(auth()->user()->user_type===2){
//             return '/admin';
//         }
//         else {
//             return '/';
//         }

// }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
