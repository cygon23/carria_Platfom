<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\LoginAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;

class DashboardController extends Controller
{
    public function index()
    {
           $loginActivities = LoginAttempt::latest()->get();

        return view('admin.dashboard',compact('loginActivities'));
    }

public function showSubmittedCVs(Request $request)
{
    // Fetch all the files from the 'cvs' directory
    $files = Storage::disk('public')->files('cvs');

    // Optionally, you can add search functionality
    if ($request->has('search')) {
        $files = array_filter($files, function ($file) use ($request) {
            return strpos(strtolower($file), strtolower($request->search)) !== false;
        });
    }

    // Paginate the results manually
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
    $perPage = 10;
    $currentItems = array_slice($files, ($currentPage - 1) * $perPage, $perPage);
    $filesPaginator = new LengthAwarePaginator($currentItems, count($files), $perPage, $currentPage);

    // Preserve search query parameters in pagination links
    $filesPaginator->appends($request->all());

    return view('cv.submitted_cvs', compact('filesPaginator'));
}
}
