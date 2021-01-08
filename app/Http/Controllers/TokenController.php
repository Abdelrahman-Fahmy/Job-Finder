<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    //
    public function get_token(Request $request)
    {
        if($request->has('email') && $request->has('password')){
            if(Auth::attempt([
                'email'=>$request['email'],
                'password'=>$request['password']
            ])){
                $user=Auth::user();
                return $user->createToken('AppName');
            }
        }
        return response()->json(['error'=>'Unauthorised'],401);
    }
}
