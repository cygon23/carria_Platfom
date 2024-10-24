<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CVController extends Controller
{
    public function index()
    {
        return view('cv.dashboard');
    }


    public function upload(Request $request)
    {
        // Validate the uploaded file
        $validator = Validator::make($request->all(), [
            'cv' => 'required|mimes:pdf|max:2048', // Only PDF files and max size of 2MB
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();
        $cvPath = 'cvs/' . time() . '_' . $request->file('cv')->getClientOriginalName();

        // Check if the user already has a CV and delete the existing one
        if ($user->cv_url) {
            Storage::delete('private/' . $user->cv_url); // Delete from the correct disk
        }

        // Store the new CV in the private directory
        $request->file('cv')->storeAs('private/cvs', $cvPath);

        // Update user's CV URL in the database
        $user->cv_url = $cvPath;
        $user->save();

        return redirect()->back()->with('success', 'CV uploaded successfully!');
    }


    public function basic()
    {
        return view('cv.basic');
    }

    // public function upload(Request $request)
    // {
    //     // Validate the uploaded file
    //     $validator = Validator::make($request->all(), [
    //         'cv' => 'required|mimes:pdf|max:2048', // Only PDF files and max size of 2MB
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     $user = Auth::user();
    //     $cvPath = 'cvs/' . time() . '_' . $request->file('cv')->getClientOriginalName();

    //     // Check if the user already has a CV and delete the existing one
    //     if ($user->cv_url) {
    //         Storage::delete('private/' . $user->cv_url); // Delete the existing CV
    //     }

    //     // Store the new CV in the private directory
    //     $request->file('cv')->storeAs('private/cvs', $cvPath);

    //     // Update user's CV URL in the database
    //     $user->cv_url = $cvPath;
    //     $user->save();

    //     return redirect()->back()->with('success', 'CV uploaded successfully!')->with('cv_url', $cvPath);
    // }




    // public function preview()
    // {
    //     $user = Auth::user();

    //     if ($user && $user->cv_url) {
    //         $path = storage_path('app/private/' . $user->cv_url);

    //         if (file_exists($path)) {
    //             return response()->file($path);
    //         }
    //     }

    //     return redirect()->back()->withErrors(['error' => 'CV not found or not accessible.']);
    // }








    // public function download()
    // {
    //     $user = Auth::user();

    //     // Check if the user has a CV
    //     if ($user && $user->cv_url) {
    //         $path = storage_path('app/private/' . $user->cv_url); // Construct the full path

    //         // Debugging output (you can remove this later)
    //         \Log::info('Checking for CV at: ' . $path); // Log the path being checked

    //         // Check if the file exists
    //         if (file_exists($path)) {
    //             // Return a download response
    //             return response()->download($path);
    //         } else {
    //             \Log::error('File not found: ' . $path); // Log error if file is not found
    //         }
    //     }

    //     // Redirect back with an error if the CV is not found
    //     return redirect()->back()->withErrors(['error' => 'CV not found or not accessible.']);
    // }
}
