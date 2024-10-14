<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobApplicationController extends Controller
{
    public function index()
    {


        $applications = DB::table('job_applications')
            // Join the jobs_ table to get the job details
            ->join('jobs_', 'job_applications.job_id', '=', 'jobs_.id')

            // Join the users table to get the applicant's details (user who applied)
            ->join('users as applicant', 'job_applications.user_id', '=', 'applicant.id')

            // Self-join the users table to get the employer's details (user who posted the job)
            ->join('users as employer', 'job_applications.employer_id', '=', 'employer.id')

            // Select fields from all relevant tables
            ->select(
                'job_applications.*',
                'jobs_.title as job_title',
                'jobs_.status as job_status',           // Get the job title from the jobs_ table

                // Applicant information (from users table)
                'applicant.name as applicant_name',
                'applicant.email as applicant_email',
                'applicant.mobile as applicant_mobile',    //  "mobile" exists in users table
                'applicant.role as applicant_role',        //  "role" exists in users table
                'applicant.created_at as applicant_created_at',
                'applicant.updated_at as applicant_updated_at',


                // Employer information (from users table)
                'employer.name as employer_name',        // Employer's name
                'employer.email as employer_email',      // Employer's email
                'employer.mobile as employer_mobile',    // Employer's mobile
                'employer.role as employer_role',        // Employer's role
                'job_applications.applied_date',

            )
            ->orderBy('job_applications.created_at', 'DESC') // Order by application date
            ->paginate(5);  // Paginate the results (5 per page)


        return view('admin.job_application.list', [
            'applications' => $applications
        ]);
    }
}
