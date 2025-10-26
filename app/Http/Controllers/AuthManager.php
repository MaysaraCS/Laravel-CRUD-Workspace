<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;

class AuthManager extends Controller
{
    // Show login page
    public function login()
    {
        return view('auth.login');
    }

    // Handle login form
    public function loginPost(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->withInput();
    }


    function logout(){
        Auth::logout();
        return redirect(route("login"));
    }

    // Show register page
    public function register()
    {
        return view('auth.register');
    }

    // Handle registration form
    public function registerPost(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); 

        if ($user->save()) {
            return redirect(route('login'))
                ->with('success', 'Registration Successful');
        }

        return back()->with('error', 'Registration Failed')->withInput();
    }
}
