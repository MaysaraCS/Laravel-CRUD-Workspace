<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthManager extends Controller
{
    function login(){
        return view('auth.login');
    }

    function loginPost(Request $request){
        $request->validate([
            'username'=> 'required',
            'email'=> 'required',
            'password'=> 'required|min:8',
        ]);
        $credentials = $request->only('username','email','password');
        if(Auth::attempt($credentials)){
            return redirect()->intended(route("home"));
        }
        return redirect(route("login"))
            ->with("error", "Invalid Email Or Password");
    }

    function register(){
        return view('auth.register');
    }
    function registerPost(Request $request){
        $request->validate([
            'username'=> 'required',
            'email'=> 'required|email',
            'password'=> 'required|min:8',
        ]);
        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = $request->password;
        if($user->save()){
            return redirect(route("login"))
                ->with("success","Registration Successful");
        }
        return redirect(route("register"))
            ->with("error", "Registration Failed"); 
    }
}
