<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use App\Models\JobType;
use Illuminate\Http\Request;

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
}
