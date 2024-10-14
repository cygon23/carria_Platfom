<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Job;
use App\Models\JobType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobAdminController extends Controller
{
    public function index()
    {

        $applicantCounts = DB::table('job_applications')
            ->select('job_id', DB::raw('COUNT(*) as applicant_count'))
            ->groupBy('job_id');

        $jobs = DB::table('jobs_')
            ->join('users', 'jobs_.user_id', '=', 'users.id')
            ->leftJoinSub($applicantCounts, 'applicant_counts', function ($join) {
                $join->on('jobs_.id', '=', 'applicant_counts.job_id');
            })
            ->select(
                'jobs_.*',
                'users.name as user_name',
                'users.email as user_email',
                'applicant_counts.applicant_count'
            )
            ->where('jobs_.is_delete', 0)
            ->orderBy('jobs_.created_at', 'DESC')
            ->paginate(5);


        return view('admin.jobs.list', ['jobs' => $jobs]);
    }

    public function editJob($id)
    {
        $job = Job::findOrFail($id);
        $categories  = Category::orderBy('name', 'ASC')->get();
        $jobTypes  = JobType::orderBy('name', 'ASC')->get();

        return view(
            'admin.jobs.Admn-edit',
            [
                'job' => $job,
                'categories' => $categories,
                'jobTypes' => $jobTypes

            ]
        );
    }



    public function  adminUpdateJob(Request $request, $id)
    {
        // Validation rules
        $rules = [
            'title' => 'required|min:5|max:200',
            'category' => 'required',
            'job_nature' => 'required',
            'vacancy' => 'required|integer',
            'location' => 'required|max:50',
            'description' => 'required',
            'keywords' => 'required',
            'company_name' => 'required|min:3|max:75',
            'salary' => 'nullable',  // Optional field
            'benefits' => 'nullable',  // Optional field
            'responsibility' => 'nullable',  // Optional field
            'qualification' => 'nullable',  // Optional field
            'experience' => 'required|integer',  // Mandatory field
            'company_location' => 'nullable',  // Optional field
            'company_website' => 'nullable|url'  // Optional field, validate URL format
        ];

        // Validate the incoming request using the defined rules
        $validatedData = $request->validate($rules);


        // Storing the job data
        $job = Job::find($id);

        $job->title = $validatedData['title'];
        $job->category_id = $validatedData['category']; // Make sure to use category id
        $job->job_type_id = $validatedData['job_nature']; // Make sure to use job type id
        $job->vacancy = $validatedData['vacancy'];
        $job->salary = $validatedData['salary'] ?? null;
        $job->location = $validatedData['location'];
        $job->description = $validatedData['description'];
        $job->benefits = $validatedData['benefits'] ?? null;
        $job->responsibility = $validatedData['responsibility'] ?? null;
        $job->qualification = $validatedData['qualification'] ?? null;
        $job->keywords = $validatedData['keywords'];
        $job->experience = $validatedData['experience'];
        $job->company_name = $validatedData['company_name'];
        $job->company_location = $validatedData['company_location'] ?? null;  // Optional field
        $job->company_website = $validatedData['company_website'] ?? null;  // Optional field
        $job->status = $request->status;
        $job->isFeatured = (!empty($request->isFeatured)) ? $request->isFeatured : 0;
        $job->save();

        // Redirect or return a response after successfully saving
        return redirect()->route('dashboard.index')->with('success', 'Job updated successfully!');
    }

    public function admindeleteJob(Request $request)
    {
        $id = $request->id;
        $job = Job::find($id);

        if ($job == null) {
            abort(404);
        }
        $job->is_delete = 1;
        $job->save();

        return redirect()->back()->with('success', 'Job marked as deleted.');
    }
}
