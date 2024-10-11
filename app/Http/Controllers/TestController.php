<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        // Storing the job data using query builder
        DB::table('jobs_')

            ->update([
                'title' => $validatedData['title'],
                'category_id' => $validatedData['category'], // Use category ID
                'job_type_id' => $validatedData['job_nature'], // Use job type ID
                'user_id' => Auth::user()->id,
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
                'updated_at' => now()  // Ensure the timestamp is updated
            ]);

        // Redirect or return a response after successfully saving
        return redirect()->route('my-job')->with('success', 'Job updated successfully!');
    }
}
