<?php

namespace App\Http\Controllers;

use App\Mail\JobNotificationMail;
use App\Models\Category;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\JobType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class JobController extends Controller
{
    //showing the job page

    public function index(Request $request)
    {

        $categories = Category::where('status', 1)->get();
        $jobTypes = JobType::where('status', 1)->get();

        $jobs = Job::where('status', 1);

        //searching using keyword
        if (!empty($request->keyword)) {
            $jobs = $jobs->where(function ($e) use ($request) {
                $e->orWhere('title', 'like', '%' . $request->keyword . '%');
                $e->orWhere('keywords', 'like', '%' . $request->keyword . '%');
            });
        }

        // seaching fusing location
        if (!empty($request->location)) {
            $jobs = $jobs->where('location', $request->location);
        }

        //searching using category

        if (!empty($request->category)) {
            $jobs = $jobs->where('category_id', $request->category);
        }


        //to mark checked box
        $jobsTypeArray = [];
        //searching using job Type  user can join arous types such location,types etc

        if (!empty($request->jobType)) {
            $jobsTypeArray = explode(',', $request->jobType);
            $jobs = $jobs->whereIn('job_type_id', $jobsTypeArray);
        }

        //searching using Exeprience

        if (!empty($request->experience)) {
            $jobs = $jobs->where('experience', $request->experience);
        }

        $jobs = $jobs->with(['JobType', 'category']);
        //condition for sorting
        if ($request->sort == '0') {
            $jobs =  $jobs->orderBy('created_at', 'ASC');
        } else {
            $jobs =  $jobs->orderBy('created_at', 'DESC');
        }

        $jobs =  $jobs->paginate(9);



        return view('front.jobs.jobs', [
            'categories' =>   $categories,
            'jobTypes' =>   $jobTypes,
            'jobs' => $jobs,
            'jobsTypeArray' =>  $jobsTypeArray
        ]);
    }
    public function jobDetail($id)
    {
        //fetching job details form db
        $job = Job::where([
            'id' => $id,
            'status' => 1
        ])->with(['jobType', 'category'])->first();


        if ($job == null) {
            abort(404);
        }

        return view('front.jobs.jobDetails', ['job' => $job]);
    }


    public function applyJob(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:jobs_,id',
        ]);

        $id = $request->id;
        $job = Job::where('id', $id)->first();

        // If job is not found
        if ($job === null) {
            return redirect()->back()->with('error', 'Oops! Job not yet uploaded.');
        }

        // Uploaded job cannot be applied by the same person
        $employer_id = $job->user_id;
        if ($employer_id == Auth::user()->id) {
            return redirect()->back()->with('error', 'You cannot apply for your own job.');
        }


        //you can not apply the job twice
        $jobApplicationCount = JobApplication::where([
            'user_id' => Auth::user()->id,
            'job_id' => $id
        ])->count();

        if ($jobApplicationCount > 0) {
            return redirect()->back()->with('error', 'It appears that you have already applied for this position Please check your application status for any updates.');
        }
        // Create the application
        try {
            $application = new JobApplication();
            $application->job_id = $id;
            $application->user_id = Auth::user()->id; // Applicant's ID
            $application->employer_id = $employer_id; // Store employer ID if needed
            $application->applied_date = now();
            $application->save();


            //send notification email to employer
            // $employer = User::where('id', $employer_id)->first();
            // $mailData = [
            //     'employer' => $employer,
            //     'user' => Auth::user(),
            //     'job' => $job
            // ];
            // Mail::to($employer->email)->send(new JobNotificationMail($mailData));

            return redirect()->back()->with('success', 'Application done successfully');
        } catch (\Exception $e) {
            Log::error("Job application error: " . $e->getMessage());  // Log the error
            return redirect()->back()->with('error', 'An error occurred while applying for the job.');
        }
    }
}
