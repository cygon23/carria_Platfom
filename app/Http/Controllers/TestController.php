<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\NewJobPostedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Twilio\Rest\Client;

class TestController extends Controller
{
    public function addJobs(Request $request)
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
            'salary' => 'nullable',
            'benefits' => 'nullable',
            'responsibility' => 'nullable',
            'qualification' => 'nullable',
            'experience' => 'required|integer',
            'company_location' => 'nullable',
            'company_website' => 'nullable|url'
        ];

        // Validate the incoming request using the defined rules
        $validatedData = $request->validate($rules);

        // Insert the new job data
        DB::table('jobs_')->insert([
            'title' => $validatedData['title'],
            'category_id' => $validatedData['category'], // Use category ID
            'job_type_id' => $validatedData['job_nature'], // Use job type ID
            'user_id' => Auth::user()->id,  // Associate job with the logged-in user
            'vacancy' => $validatedData['vacancy'],
            'salary' => $validatedData['salary'] ?? null, // Optional
            'location' => $validatedData['location'],
            'description' => $validatedData['description'],
            'benefits' => $validatedData['benefits'] ?? null, // Optional
            'responsibility' => $validatedData['responsibility'] ?? null, // Optional
            'qualification' => $validatedData['qualification'] ?? null, // Optional
            'keywords' => $validatedData['keywords'],
            'experience' => $validatedData['experience'],
            'company_name' => $validatedData['company_name'],
            'company_location' => $validatedData['company_location'] ?? null,  // Optional
            'company_website' => $validatedData['company_website'] ?? null,  // Optional
            'created_at' => now(),  // Store timestamp for when the job was created
            'updated_at' => now()   // Store timestamp for when the job was updated
        ]);


     // Initialize Twilio client
    $twilio = new Client(config('services.twilio.sid'), config('services.twilio.token'));



    // Get users with valid phone numbers only
    $users = User::whereNotNull('mobile')
                 ->where('mobile', '!=', '')
                 ->get();


    foreach ($users as $user) {
        if (preg_match('/^\+?[1-9]\d{1,14}$/', $user->mobile)) {
            $twilio->messages->create(
                $user->mobile,
                [
                    'from' => '+12564748476',
                    'body' => "A new job has been posted: {$validatedData['title']}. Check it out!"
                ]
            );
        }
    }

        return redirect()->route('my-job')->with('success', 'Job posted successfully!');
    }
}
