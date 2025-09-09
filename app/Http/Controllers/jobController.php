<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\User;


class jobController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $jobs = job::latest()->paginate(10);
        return view('jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // dd($request->file('company_logo'));
        $validatedData = $request->validate(
            [
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'salary' => 'required|integer',
                'tags' => 'nullable|string',
                'job_type' => 'required|string',
                'remote' => 'required|boolean',
                'requirements' => 'nullable|string',
                'benefits' => 'nullable|string',
                'address' => 'nullable|string',
                'city' => 'required|string',
                'state' => 'required|string',
                'zipcode' => 'nullable|string',
                'contact_email' => 'required|string',
                'contact_phone' => 'nullable|string',
                'company_name' => 'required|string',
                'company_description' => 'nullable|string',
                'company_logo' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
                'company_website' => 'nullable|url'

            ]
        );

        // find current log User ID
        $validatedData['user_id'] = auth()->user()->id;
        //check for image
        if ($request->hasFile('company_logo')) {

            //store the file and get the path 
            $path = $request->file('company_logo')->store('logos', 'public');

            // add that path to database
            $validatedData['company_logo'] = $path;
        }

        //submit to database
        job::create($validatedData);
        return redirect()->route('jobs.index')->with('success', 'Job listing created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(job $job): View
    {
        return view('jobs.show')->with('job', $job);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(job $job): View
    {
        $this->authorize('update', $job);

        return View('jobs.edit')->with('job', $job);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, job $job): string
    {
        // check if user Authorized
        $this->authorize('update', $job);

        $validatedData = $request->validate(
            [
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'salary' => 'required|integer',
                'tags' => 'nullable|string',
                'job_type' => 'required|string',
                'remote' => 'required|boolean',
                'requirements' => 'nullable|string',
                'benefits' => 'nullable|string',
                'address' => 'nullable|string',
                'city' => 'required|string',
                'state' => 'required|string',
                'zipcode' => 'nullable|string',
                'contact_email' => 'required|string',
                'contact_phone' => 'nullable|string',
                'company_name' => 'required|string',
                'company_description' => 'nullable|string',
                'company_logo' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
                'company_website' => 'nullable|url'

            ]
        );


        //check for image
        if ($request->hasFile('company_logo')) {
            //if there is logo first delete that exsiting logo
            Storage::delete('public/logos/' . basename($job->company_logo));

            //store the file and get the path 
            $path = $request->file('company_logo')->store('logos', 'public');

            // add that path to database
            $validatedData['company_logo'] = $path;
        }

        //submit to database
        $job->update($validatedData);
        return redirect()->route('jobs.index')->with('success', 'Job listing Update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(job $job): RedirectResponse
    {
        $this->authorize('delete', $job);

        if ($job->company_logo) {
            Storage::delete('public/logo' . $job->company_logo);
        }
        $job->delete();

        //check if the reqwest came from dashboard
        if (request()->query('from') == 'dashboard') {
            return redirect()->route('dashboard')->with('success', 'Job listing Deleting successfully!');
        }

        return redirect()->route('jobs.index')->with('success', 'Job listing Deleting successfully!');
    }
    //@desc Search Job Listings
    //@route GET/jobs/search
    public function search(Request $request): View
    {
        $keywords = strtolower($request->input('keywords'));
        $location = strtolower($request->input('location'));
        $query = job::query();

        if ($keywords) {
            $query->where(function ($q) use ($keywords) {
                $q->whereRaw('LOWER(title) like ?', ['%' . $keywords . '%'])
                    ->orWhereRaw('LOWER(description) like ?', ['%' . $keywords . '%'])
                    ->orWhereRaw('LOWER(tags) like ?', ['%' . $keywords . '%']);
            });
        }
        if ($location) {
            $query->where(function ($q) use ($location) {
                $q->whereRaw('LOWER(address) like ?', ['%' . $location . '%'])
                    ->orWhereRaw('LOWER(city) like ?', ['%' . $location . '%'])
                    ->orWhereRaw('LOWER(state) like ?', ['%' . $location . '%'])
                    ->orWhereRaw('LOWER(zipcode) like ?', ['%' . $location . '%'])
                ;
            });
        }
        $jobs = $query->paginate(12);
        return view('jobs.index')->with('jobs',$jobs);
    }
}
