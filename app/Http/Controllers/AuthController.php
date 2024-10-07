<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use App\Models\JobType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'designation' => 'required|string|min:7|max:50',
        ]);

        // If validation fails
        if ($validator->fails()) {
            session()->flash('error', 'consider length please.');
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


    public function saveJob(Request $request)
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
        $job = new Job();

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
        return redirect()->route('my-job')->with('success', 'Job Added successfully!');
    }


    public function myJobs()
    {
        $jobs = Job::where('user_id', Auth::user()->id)->with('JobType')->paginate(2);

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

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('warning', 'succefully loged out');
    }
}
