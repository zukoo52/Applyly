<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // @desc show login form 
    // @desc This function handles user login and session creation.
    // @route GET/Login
    public function login(): view
    {
        return view('auth.login');
    }

    // @desc Authenticate User
    // @route POST/login
    public function authenticate(Request $request): RedirectResponse
    {

        $credentials = $request->validate([

            'email' => 'required|string|email|max:100',
            'password' => 'required|string',

        ]);
        // attempet to authenticate user
        if (Auth::attempt($credentials)) {
            // Regenarate  the sessions to prevent fixation attects
            $request->session()->regenerate();
            return redirect()->intended(route('home'))->with('success', 'you are now logged in! ');
        }
        // if auth fails, redirect with error
        return back()->withErrors([
            'email' => 'The Provided credentials do not match to our records'
        ])->onlyInput('email');
    }
    // @desc show login form 
    // @route POST/Logout

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();


        return redirect('/')->with('success', 'You have been logged out.');
    }
}
