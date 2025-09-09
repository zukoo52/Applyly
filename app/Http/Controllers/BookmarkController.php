<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Job;

class BookmarkController extends Controller
{
    // @desc Get all user bookmarks
    // @route GET/bookmarks
    public function inedx(): View
    {
        $user = Auth::user();
        $bookmarks = $user->bookmarkedJobs()->orderBy('job_user_bookmarks.created_at', 'desc')->paginate(9);
        return view('jobs.bookmarked')->with('bookmarks', $bookmarks);
    }
    // @desc create new bookmarks
    // @route POST/bookmarks/{job}
    public function store(job $job): RedirectResponse
    {
         $user = Auth::user();

       //check if the job already bookmarked
       if($user->bookmarkedJobs()->where('job_id', $job->id)->exists()){
        return back()->with('error','Job is Already bookMarked!');
       }
       //Create a new bookmark
       $user->bookmarkedJobs()->attach($job->id);
        return back()->with('success','Job bookMarked Successfully');
    }
    // @desc delete bookmarks
    // @route delete/bookmarks/{job}
    public function destroy(job $job): RedirectResponse
    {
         $user = Auth::user();

       //check if the bookmark releted to the user
       if(!$user->bookmarkedJobs()->where('job_id', $job->id)->exists()){
        return back()->with('error','Job is not bookMarked!');
       }
       //remove bookmark
       $user->bookmarkedJobs()->detach($job->id);
        return back()->with('success','BookMarked Remove Successfully');
    }
}
