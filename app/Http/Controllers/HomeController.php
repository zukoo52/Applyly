<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Job;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
     {

        $jobs = job::latest()->Limit(6)->get();
        return view('pages.index')->with('jobs' , $jobs);
}
}
