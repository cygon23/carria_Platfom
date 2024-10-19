<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordEmail;
use App\Mail\VeryfyEmail;
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
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Flasher\Prime\FlasherInterface;


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
        $save->remember_token = Str::random(40);
        $save->save();

        Mail::to($save->email)->send(new VeryfyEmail($save));
        return redirect('login')->with('success', 'check to you inbox to very email address');
    }


    public function verify($token)
    {
        $user = User::where('remember_token', '=', $token)->first();

        if (!empty($user)) {


            $user->email_verified_at = Carbon::now();
            $user->remember_token = Str::random(40);
            $user->save();
            flash()->success('Your Email Successfully Verified.');
            return redirect('login');
        } else {
            abort(404);
        }
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


            if (!empty(Auth::user()->email_verified_at)) {
                // Redirect to profile if email is verified
                return redirect()->route('profile')->with('success', 'Welcome back! ' . Auth::user()->name);
            } else {
                // User is logged in but has not verified their email
                $user = Auth::user(); // Get the authenticated user
                Auth::logout(); // Log the user out

                // Generate a new verification token
                $user->remember_token = Str::random(40);
                $user->save();

                // Send the verification email
                Mail::to($user->email)->send(new VeryfyEmail($user));
                flash()->success('Please Check to your email box to verify the email.');

                return redirect()->back();
            }
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

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'different:old_password',  // New password must be different from old password
            ],
            'confirm_password' => 'required|same:new_password',
        ]);



        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        // Check if the old password matches the user's current password
        if (!Hash::check($request->old_password, Auth::user()->password)) {
            return redirect()->back()->withErrors(['old_password' => 'Old password is incorrect']);
        }

        // Update the password
        Auth::user()->update([
            'password' => Hash::make($request->new_password)
        ]);

        // Redirect with success message
        return redirect()->back()->with('success', 'Password updated successfully');
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

        $user = Auth::user();

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


    public function forgotPassword()
    {
        return view('auth.forgot-pass');
    }

    public function processForgotPassword(Request $request)
    {
        $rules = [
            'email' => [
                'required',
                'email',
                'exists:users,email',
                // 'regex:/^[A-Za-z0-9._%+-]+@(gmail\.com|yahoo\.com|protonmail\.com|example\.com|yourcompany\.com)$/|unique:users,email'
            ],
        ];

        // Validate the request with custom error messages
        $validatedData = $request->validate($rules, [
            'email.regex' => 'Please use a Gmail, Yahoo, or ProtonMail email address.',
            'email.exists' => 'The email does not exist in our system.',
        ]);

        $token = Str::random(40);
        //delete if exit
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now()
        ]);

        //sending email
        $user = User::where('email', $request->email)->first();
        $mailData = [
            'token' => $token,
            'user' => $user,
            'subject' => 'Reset password Link'
        ];

        Mail::to($request->email)->send(new ResetPasswordEmail($mailData));

        return redirect()->route('login')->with('success', 'Please check you inbox to reset passowrd');
    }

    //sending link

    public function emailResetPassword($tokenString)
    {
        //delete if exit
        $token =  DB::table('password_reset_tokens')->where('token', $tokenString)->first();
        if ($token == null) {
            return redirect()->route('password-forgot')->with('error', 'Invalid request Please try again');
        }

        // Check if the token has expired (5 minutes from the time it was created)
        if (Carbon::parse($token->created_at)->addMinutes(5)->isPast()) {
            return redirect()->route('password-forgot')->with('error', 'The reset token has expired.');
        }

        return view('auth.reset-password', [
            'tokenString' => $tokenString
        ]);
    }

    //updating the password
    public function processEmailResetPassword(Request $request)
    {
        // Check if the token is valid
        $token = DB::table('password_reset_tokens')->where('token', $request->token)->first();
        if ($token == null) {
            return redirect()->route('password-forgot')->with('error', 'Invalid request. Please try again.');
        }


        // Check if the token has expired (5 minutes from the time it was created)
        if (Carbon::parse($token->created_at)->addMinutes(5)->isPast()) {
            return redirect()->route('password-forgot')->with('error', 'The reset token has expired.');
        }

        $rules = [
            'new_password' => [
                'required',
                'string',
                'min:8',
                'max:20',
                'regex:/[a-z]/', // At least one lowercase letter
                'regex:/[A-Z]/', // At least one uppercase letter
                'regex:/[0-9]/', // At least one digit
                'regex:/[!@#$%^&*(),.?":{}|<>]/', // At least one special character
                // Ensure 'old_password' is defined in the context if it's referenced here
                //'different:old_password', // Must not be the same as old password
            ],
            'confirm_password' => [
                'required',
                'string',
                'same:new_password', // Must match the new password
            ],
        ];

        // Validate the request with custom error messages
        $validatedData = $request->validate($rules, [
            'new_password.required' => 'The new password is required.',
            'new_password.min' => 'The new password must be at least 8 characters.',
            'new_password.max' => 'The new password must not exceed 20 characters.',
            'new_password.regex' => 'The new password must contain at least one uppercase letter, one lowercase letter, one digit, and one special character.',
            //'new_password.different' => 'The new password must not be the same as the old password.',
            'confirm_password.required' => 'The confirmation password is required.',
            'confirm_password.same' => 'The  password must match .',
        ]);


        User::where('email', $token->email)->update([
            'password' => Hash::make($request->new_password)
        ]);

        DB::table('password_reset_tokens')->where('token', $request->token)->delete();

        return redirect()->route('login')->with('success', 'Your password has been reset successfully.');
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
