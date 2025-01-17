<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CVController;
use App\Models\CVuploaded;
use App\Models\LoginAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function index()
    {
           $loginActivities = LoginAttempt::latest()->get();

        return view('admin.dashboard',compact('loginActivities'));
    }

    public function showSubmittedCVs(Request $request)
    {
        // Fetch users with non-null cv_url
        $query = CVUploaded::query()->whereNotNull('cv_url');

        // Apply search filter if provided
        if ($request->has('search') && !empty($request->search)) {
            $query->where('user_name', 'like', '%' . $request->search . '%');
        }

        // Paginate the results
        $usersWithCVs = $query->paginate(10);

        return view('cv.submitted_cvs', compact('usersWithCVs'));
    }




}

