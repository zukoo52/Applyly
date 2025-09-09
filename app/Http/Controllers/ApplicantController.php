<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

use App\Models\Applicant;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use App\Models\Job;
use App\Mail\JobApplied;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ApplicantController extends Controller
{
    //@desc store new applicant
    // @route POST/jobs/{$job}/apply
    public function store(Request $request, job $job): RedirectResponse
    {

        //check if the user has alrady applied
        $existingApplication = Applicant::where('job_id', $job->id)->where('user_id', auth()->id())->exists();
        
        if($existingApplication){
            return redirect()->back()->with('error' , 'you already applied for this job');
        }


        //validating incoming data
        $validatedData = $request->validate([
            'full_name'  => 'required|string',
            'contact_phone' => 'string',
            'contact_email' => 'required|string|email',
            'massage' => 'string',
            'location' => 'string',
            // when comes to file upload use mimes: for spacify the file type
            'resume_path' => 'required|file|mimes:pdf|max:2048',

        ]);
        // Handle Resume Upload
        if ($request->hasFile('resume_path')) {
            $path = $request->file('resume_path')->store('resumes','public');
            $validatedData['resume_path'] = $path;
        }

        //store the applicant
        $application = new Applicant($validatedData);
        $application->job_id = $job->id;
        //get user id from the current log user
        $application->user_id = auth()->id();
        $application->save();

        //send email to the applicant owner 
        // Mail::to($job->user->email)->send(new JobApplied($application , $job));
        return redirect()->back()->with('success' , 'Your Application has been submitted');




    }
    // @desc Delete job applicant
    // @route DELETE /applicant/{applicant}
    public function destroy($id):RedirectResponse{
       // $this->authorize('delete', $applicant);
       $applicant = Applicant::findOrFail($id);
       
        $applicant->delete();

        
         
          return redirect()->route('dashboard')->with('success', 'Applicant  Deleting successfully!');

    }
}
