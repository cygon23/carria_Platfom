<?php

namespace App\Http\Controllers;

use App\Models\Award;
use App\Models\CvBasicInfo;
use App\Models\CvEducation;
use App\Models\CVSkill;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CVController extends Controller
{
    public function index()
    {
        //  $basicInfo = CvBasicInfo::with(['educations', 'experiences', 'skills', 'awards'])
        //     ->findOrFail($id);

        return view('cv.dashboard');
    }




public function upload(Request $request)
{
    // Validate the uploaded file
    $validator = Validator::make($request->all(), [
        'cv' => 'required|mimes:pdf|max:2048',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $user = Auth::user();

    // Check if the user already has a CV and delete the existing one
    if ($user->cv_url && Storage::exists($user->cv_url)) {
        Storage::delete($user->cv_url);
    }

    // Store the new CV in the 'public/cvs' directory
    $cvPath = $request->file('cv')->store('cvs', 'public');

    // Update the user's CV URL in the database
    $user->cv_url = $cvPath;
    $user->save();

    return redirect()->back()->with('success', 'CV uploaded successfully!');
}


public function delete(Request $request)
{
    $user = Auth::user();

    // Ensure the user has a CV URL and the file exists
    if ($user->cv_url && Storage::exists('public/' . $user->cv_url)) {
        // Delete the CV from the 'public/cvs' directory
        Storage::delete('public/' . $user->cv_url);

        // Remove the CV URL from the database
        $user->cv_url = null;
        $user->save();

        return redirect()->back()->with('success', 'CV deleted successfully!');
    }

    return redirect()->back()->with('error', 'No CV found to delete.');
}




    public function basic()
    {
        return view('cv.basic');
    }

    public function storeBasic(Request $request)
    {
        $request->validate([
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|unique:cv_basic_infos,email',
            'phone' => 'required|string|max:20',
            'description' => 'required|string',
        ]);

        $data = $request->only(['first_name', 'last_name', 'email', 'phone', 'description']);
        $data['user_id'] = Auth::id();

        // Handle profile photo upload if provided
        if ($request->hasFile('photo')) {
            $filePath = $request->file('photo')->store('photos', 'public');
            $data['photo'] = $filePath;
        }

        CvBasicInfo::create($data);

        return redirect()->route('cv.education')->with('success', 'Basic information saved successfully!');
    }


    public function education()
    {
        return view('cv.education');
    }


    public function storeEducation(Request $request)
    {
        $request->validate([
            'institution_name' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'field_of_study' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        $cvBasicInfo = CvBasicInfo::where('user_id', Auth::id())->firstOrFail();

        CvEducation::create([
            'cv_basic_info_id' => $cvBasicInfo->id,
            'institution_name' => $request->institution_name,
            'degree' => $request->degree,
            'field_of_study' => $request->field_of_study,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
        ]);

        return redirect()->route('cv.experience')->with('success', 'Education information saved successfully!');
    }


    public function experience()
    {
        return view('cv.experience');
    }


    public function storeExperience(Request $request)
    {
        $request->validate([
            'job_title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        $basic = CvBasicInfo::where('user_id', Auth::id())->firstOrFail();

        $experience = new Experience([
            'job_title' => $request->job_title,
            'company_name' => $request->company_name,
            'location' => $request->location,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
        ]);

        $basic->experiences()->save($experience);

        return redirect()->route('cv.skills')->with('success', 'Experience added successfully!');
    }

    public function skills()
    {
        $basicInfos = CVBasicInfo::all();
        return view('cv.skills', compact('basicInfos'));
    }

    public function storeSkills(Request $request)
    {
        $request->validate([
            // 'cv_basic_info_id' => 'required|exists:cv_basic_infos,id',
            'skill_name' => 'required|string|max:255',
        ]);

        CVSkill::create($request->all());

        return redirect()->route('cv.awards')->with('success', 'Skill added successfully.');
    }


    public function awards()
    {
        return view('cv.awards');
    }


    public function storeAwards(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'award_name' => 'required|string|max:255',
            'awarding_institution' => 'required|string|max:255',
            'date_awarded' => 'required|date',
            'description' => 'nullable|string',
        ]);

        // Create the award record in the database
        Award::create($request->all());

        // Redirect back with a success message
        return redirect()->route('account.cv')->with('success', 'Award added successfully is cv now is complete.');
    }


    public function preview($id)
    {
        // Fetch the CV basics information by user ID
        $basicInfo = CvBasicInfo::with(['educations', 'experiences', 'skills', 'awards'])
            ->findOrFail($id);

        return view('cv.preview', compact('basicInfo'));
    }

}
