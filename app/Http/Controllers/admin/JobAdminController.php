<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Job;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobAdminController extends Controller
{
    public function index()
    {

        $applicantCounts = DB::table('job_applications')
            ->select('job_id', DB::raw('COUNT(*) as applicant_count'))
            ->groupBy('job_id');

        $jobs = DB::table('jobs_')
            ->join('users', 'jobs_.user_id', '=', 'users.id')
            ->leftJoinSub($applicantCounts, 'applicant_counts', function ($join) {
                $join->on('jobs_.id', '=', 'applicant_counts.job_id');
            })
            ->select(
                'jobs_.*',
                'users.name as user_name',
                'users.email as user_email',
                'applicant_counts.applicant_count'
            )
            ->orderBy('jobs_.created_at', 'DESC')
            ->paginate(5);


        return view('admin.jobs.list', ['jobs' => $jobs]);
    }
}
