<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\JobType;
use App\Models\SaveJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function processRegistration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|max:20|confirmed',
            'password_confirmation' => 'required'
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $save = new User;
        $save->name = trim($request->name);
        $save->email = trim($request->email);
        // $save->password = Hash::make(trim($request->password));
        $save->password = Hash::make(trim($request->password));
        $save->save();

        return redirect('login')->with('success', 'your succefully createated an account');
    }

    public function login()
    {
        return view('auth.login');
    }


    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('profile')->with('success', 'Welcome back!');
        } else {
            return redirect()->back()->withErrors(['error' => 'Invalid email or password.']);
        }
    }


    public function profile()

    {
        $id = Auth::user()->id;

        $user = User::where('id', $id)->first();

        return view('auth.profile', [
            'user' => $user
        ]);
    }

    public function updateProfile(Request $request)
    {
        $id = Auth::user()->id;

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5|max:20',
            'email' => 'required|email|unique:users,email,' . $id,
            'mobile' => ['required', 'regex:/^\+?[0-9]{10,15}$/'],
            'designation' => 'required|string|min:5|max:50',
        ]);

        // If validation fails
        if ($validator->fails()) {
            session()->flash('error', 'consider length please.name minmum 5, moblie 10+,desgnation minmum 5');
            return redirect()->back()->withInput()->with('validationErrors', $validator->errors());
        }


        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->designation = $request->designation;
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function profileImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // 2MB Max
        ]);

        $user = Auth::user()->id;

        if ($request->hasFile('image')) {
            // Delete old image if exists and it's not the default
            if ($user->image && $user->image !== 'images/default_avatar.png') {
                $oldImagePath = str_replace('storage/', 'public/', $user->image);
                Storage::delete($oldImagePath);
            }

            $path = $request->file('image')->store('profile_images', 'public');
            $user->image = 'storage/' . $path; // Update image path
            $user->save();
        }

        return redirect()->back()->with('success', 'Profile image updated successfully.');
    }




    public function createJob()
    {
        $categories = Category::orderBy('name', 'ASC')->where('status', 1)->get();

        $job_types = JobType::orderBy('name', 'ASC')->where('status', 1)->get();


        return view('front.jobs.create', [
            'categories' => $categories,
            'job_types' =>  $job_types,
        ]);
    }


    // public function addJobs(Request $request)

    // {


    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'category' => 'required|integer',
    //         'job_nature' => 'required|integer',
    //         'vacancy' => 'required|integer',
    //         'location' => 'required|string|max:255',
    //         'description' => 'required|string',
    //         'experience' => 'required|integer',
    //         'keywords' => 'required|string',
    //         'company_name' => 'required|string|max:255',
    //     ]);

    //     Job::create([
    //         'title' => $request->title,
    //         'category_id' => $request->category,
    //         'job_type_id' => $request->job_nature,
    //         'vacancy' => $request->vacancy,
    //         'salary' => $request->salary,
    //         'location' => $request->location,
    //         'description' => $request->description,
    //         'benefits' => $request->benefits,
    //         'responsibility' => $request->responsibility,
    //         'qualification' => $request->qualification,
    //         'experience' => $request->experience,
    //         'keywords' => $request->keywords,
    //         'company_name' => $request->company_name,
    //         'company_location' => $request->company_location,
    //         'company_website' => $request->website,
    //     ]);

    //     return response()->json(['success' => 'Job created successfully!']);
    // }




    public function myJobs()
    {

        $jobs = Job::where('user_id', Auth::user()->id)
            ->where('is_delete', 0) // Exclude deleted jobs
            ->with('JobType')
            ->orderBy('created_at', 'DESC')
            ->paginate(5);

        return view('front.jobs.myJobs', [
            'jobs' => $jobs
        ]);
    }


    public function editJob(Request $request, $id)
    {

        $categories = Category::orderBy('name', 'ASC')->where('status', 1)->get();

        $job_types = JobType::orderBy('name', 'ASC')->where('status', 1)->get();


        $job = Job::where([
            'user_id' => Auth::user()->id,
            'id' => $id
        ])->first();

        //if job isnull
        if ($job == null) {
            abort(404);
        }

        return view('front.jobs.edit', [
            'categories' => $categories,
            'job_types' =>  $job_types,
            'job' => $job,

        ]);
    }


    public function updateJob(Request $request, $id)
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
        $job->user_id = Auth::user()->id;
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
        $job->save();

        // Redirect or return a response after successfully saving
        return redirect()->route('my-job')->with('success', 'Job updated successfully!');
    }



    public function deleteJob(Request $request)
    {
        // Check if job exists and belongs to the authenticated user
        $job = DB::table('jobs_')
            ->where('user_id', Auth::user()->id)
            ->where('id', $request->id)
            ->first();

        if (!$job) {
            return redirect()->back()->with('error', 'Job not found or already deleted');
        }

        // Mark the job as deleted (set is_delete to 1)
        DB::table('jobs_')->where('id', $request->id)->update(['is_delete' => 1]);

        return redirect(route('my-job'))->with('success', 'Job deleted successfully');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('warning', 'succefully loged out');
    }


    public function myJobApplication()
    {
        // Fetch job applications for the authenticated user
        $jobApplications = DB::table('job_applications')
            ->where('job_applications.user_id', Auth::user()->id)
            ->where('job_applications.is_delete', 0)
            ->join('jobs_', 'job_applications.job_id', '=', 'jobs_.id')
            ->select(
                'job_applications.job_id',
                'jobs_.title',
                'jobs_.location',
                'jobs_.status',
                'jobs_.created_at as job_created_at',
                'job_applications.applied_date'
            )
            ->groupBy('job_applications.job_id', 'jobs_.title', 'jobs_.location', 'jobs_.status', 'jobs_.created_at', 'job_applications.applied_date')
            ->orderBy('applied_date', 'DESC')
            ->paginate(3);

        // Count total applicants for each job
        $totalJobCounts = DB::table('job_applications')
            ->select('job_id', DB::raw('COUNT(DISTINCT user_id) as total_applicants')) // Count distinct user IDs
            ->where('is_delete', 0) // Ensure to only count non-deleted applications
            ->groupBy('job_id') // Group by job ID
            ->get()
            ->keyBy('job_id'); // Key the results by job ID



        return view('front.jobs.myJobApplication', [
            'jobApplications' => $jobApplications,
            'totalJobCounts' => $totalJobCounts
        ]);
    }



    public function savedJobAccount()
    {
        $savedJobs = DB::table('saved_jobs')
            ->join('jobs_', 'saved_jobs.job_id', '=', 'jobs_.id')
            ->select(
                'saved_jobs.id as saved_job_id', //  alias to avoid confusion
                'jobs_.id as job_id',
                'jobs_.title',
                'jobs_.location',
                'jobs_.status',
                'saved_jobs.created_at as saved_at' // The time when the job was saved
            )
            ->where('saved_jobs.user_id', Auth::user()->id)
            ->where('saved_jobs.is_delete', 0)
            ->orderBy('saved_at', 'DESC')
            ->paginate(10);



        return view('front.jobs.savedJob', [
            'savedJobs' => $savedJobs
        ]);
    }


    public function removeJob($jobId)
    {
        $jobApplication = DB::table('job_applications')->where('id', $jobId)->first();

        if ($jobApplication) {
            DB::table('job_applications')->where('id', $jobId)->update(['is_delete' => 1]);

            return redirect()->back()->with('success', 'Job application removed successfully.');
        }

        return redirect()->back()->with('error', 'Job application not found.');
    }


    public function removeSavedJob($jobId)
    {

        $savedJob = DB::table('saved_jobs')
            ->where('job_id', $jobId)
            ->where('user_id', Auth::id())
            ->where('is_delete', 0)
            ->first();

        if ($savedJob) {
            DB::table('saved_jobs')
                ->where('job_id', $jobId)
                ->where('user_id', Auth::id())
                ->update(['is_delete' => 1]);

            return redirect()->back()->with('success', 'Saved job removed successfully.');
        }

        return redirect()->back()->with('error', 'Saved job not found.');
    }
}
