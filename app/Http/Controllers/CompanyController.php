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
        $company->images()->create([
            'path' => 'storage/' . $imagePath,
            'image_path' => 'storage/' . $imagePath,
        ]);
    }
} else {
    // If no image is uploaded, set image_path as NULL
    $company->images()->create([
        'path' => null,
        'image_path' => null,
    ]);
}


// Save Job Positions and Their Images
foreach ($request->job_positions as $jobData) {
    $jobImagePath = null;  // Initialize as null in case no image is provided

    // Check if image is valid and store it
    if (isset($jobData['image']) && $jobData['image']->isValid()) {
        $jobImagePath = 'storage/' . $jobData['image']->store('job_images', 'public');
    }

    // Create job position with image path
    $company->jobPositions()->create([
        'title' => $jobData['title'],
        'description' => $jobData['description'],
        'image_path' => $jobImagePath,  // This will be null if no image is provided
    ]);
}



    return redirect()->route('companies')->with('success', 'Company and job positions added successfully.');
}





}
