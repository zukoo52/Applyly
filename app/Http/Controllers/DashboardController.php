<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;


class DashboardController extends Controller
{
    // @desc show all user job listings
    // @route Get/Dashboard
    public function index(): View{
        //get the loged in user
       $user = Auth::user(); 

       //get the user releted job listings
       $jobs = Job::where('user_id' , $user->id)->with('applicants')->get();
       return view('dashboard.index', compact('user','jobs'));

}


}