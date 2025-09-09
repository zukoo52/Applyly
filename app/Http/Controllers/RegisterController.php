<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // @desc show register form
    // @route Get/register
    public function register(): View
    {

        return view('auth.register');
    }

    // @desc store register form
    // @route POST/register

    public function store(Request $request): RedirectResponse
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:8|confirmed',

        ]);
        // hash the password
        $validatedData['password'] = Hash::make($validatedData['password']);

        //create user
        $user = User::create($validatedData);
        return redirect()->route('login')->with('success', 'Register Successfully You Can Login Now');
    }
}
