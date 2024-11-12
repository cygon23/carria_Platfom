<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
     public function index()
    {
        $companies = Company::with('jobPositions')->paginate(1);
        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        return view('companies.create');
    }

  public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'about' => 'required|string',
        'offer' => 'required|string',
        'location' => 'required|string',
        'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'job_positions' => 'array',
        'job_positions.*.title' => 'required|string|max:255',
        'job_positions.*.description' => 'required|string',
        'job_positions.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $company = new Company([
        'name' => $request->name,
        'about' => $request->about,
        'offer' => $request->offer,
        'location' => $request->location,
    ]);
    $company->save();

    // Save Company Images
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $imagePath = $image->store('company_images', 'public');
            $company->images()->create(['path' => $imagePath]);
        }
    }

    // Save Job Positions and Their Images
    foreach ($request->job_positions as $jobData) {
        $job = $company->jobPositions()->create([
            'title' => $jobData['title'],
            'description' => $jobData['description'],
        ]);

        if (isset($jobData['image']) && $jobData['image']->isValid()) {
            $jobImagePath = $jobData['image']->store('job_images', 'public');
            $job->update(['image_path' => $jobImagePath]);
        }
    }

    return redirect()->route('companies')->with('success', 'Company and job positions added successfully.');
}


}
