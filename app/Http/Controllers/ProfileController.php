<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    // @desc This function update profile info.
    // @route Put/profile
    public function update(Request $request): RedirectResponse
    {
        // get logged in user
        $user = Auth::user();

        //validate data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
            'avatar' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048'

        ]);
        //get user name and email
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // handle avatar upload
       if($request->hasFile('avatar')){
           // delete old avatar
           if($user->avatar){
            Storage::delete('public/' . $user->avatar);

           }
            //store the file and get the path 
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            
            // add that path to database
          $user->avatar = $avatarPath;

        }

 
        // update user info
        $user->save();


        return redirect()->route('dashboard')->with('success', 'profile info updated!');
    }
}
