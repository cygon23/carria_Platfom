<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\LoginAttempt;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
           $loginActivities = LoginAttempt::latest()->get();

        return view('admin.dashboard',compact('loginActivities'));
    }
}
