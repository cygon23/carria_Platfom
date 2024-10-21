<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use App\Models\JobType;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function index()
    {

        $categories = Category::where('status', 1)->orderBY('name', 'ASC')->take(8)->get();
        $newCategories = Category::where('status', 1)->orderBY('name', 'ASC')->get();
        $featuredJobs = Job::where('status', 1)
            ->orderBY('created_at', 'DESC')
            ->with('JobType')
            ->where('isFeatured', 1)
            ->take(6)->get();

        $latestJobs = Job::where('status', 1)
            ->with('JobType')
            ->orderBY('created_at', 'DESC')
            ->take(6)->get();



        return view('front.home', [
            'categories' =>  $categories,
            'featuredJobs' =>  $featuredJobs,
            'latestJobs' =>   $latestJobs,
            'newCategories' => $newCategories

        ]);
    }



    // public function index()
    // {
    //     // Fetching categories with a count of active jobs (status = 1)
    //     $categories = Category::where('status', 1) // Only active categories
    //         ->withCount(['jobs' => function ($query) {
    //             $query->where('status', 1); // Count only active jobs
    //         }])
    //         ->orderBy('name', 'ASC')
    //         ->take(8)
    //         ->get();

    //     $newCategories = Category::where('status', 1)
    //         ->withCount(['jobs' => function ($query) {
    //             $query->where('status', 1); // Count only active jobs
    //         }])
    //         ->orderBy('name', 'ASC')
    //         ->get();

    //     // Featured and latest jobs
    //     $featuredJobs = Job::where('status', 1)
    //         ->orderBy('created_at', 'DESC')
    //         ->with('JobType')
    //         ->where('isFeatured', 1)
    //         ->take(6)
    //         ->get();

    //     $latestJobs = Job::where('status', 1)
    //         ->with('JobType')
    //         ->orderBy('created_at', 'DESC')
    //         ->take(6)
    //         ->get();

    //     // Passing data to the view
    //     return view('front.home', [
    //         'categories' => $categories,
    //         'featuredJobs' => $featuredJobs,
    //         'latestJobs' => $latestJobs,
    //         'newCategories' => $newCategories
    //     ]);
    // }



    public function featuredCompanies()
    {
        return view('front.company');
    }

    public function exploreSection()
    {
        return view('front.explore');
    }
}
