@extends('front.layouts.app')

@section('main')
    <section class="section-4 bg-2">
        <div class="container pt-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('/account/jobs') }}">
                                    <i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp;Back to Jobs
                                </a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="container job_details_area">
            <div class="row pb-5">
                <div class="col-md-8">
                    @include('front.layouts._message')
                    <div class="card shadow border-0">
                        <!-- Job Details Section -->
                        <div class="job_details_header">
                            <div class="single_jobs white-bg d-flex justify-content-between">
                                <div class="jobs_left d-flex align-items-center">
                                    <div class="jobs_conetent">
                                        <a href="#">
                                            <h4>{{ $job->title }}</h4>
                                        </a>
                                        <div class="links_locat d-flex align-items-center">
                                            <div class="location">
                                                <p><i class="fa fa-map-marker"></i> {{ $job->location }}</p>
                                            </div>
                                            <div class="location">
                                                <p><i class="fa fa-clock-o"></i> {{ $job->JobType->name }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="jobs_right">
                                    <div class="apply_now">
                                        <a class="heart_mark" href="#"><i class="fa fa-heart-o"
                                                aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="descript_wrap white-bg">
                            <div class="single_wrap">
                                <h4>Job description</h4>
                                {!! nl2br($job->description) !!}
                            </div>

                            <div class="single_wrap">
                                <h4>Qualifications</h4>
                                {!! nl2br($job->qualification) !!}
                            </div>

                            <div class="single_wrap">
                                <h4>Responsibility</h4>
                                {!! nl2br($job->responsibility) !!}
                            </div>


                            <div class="single_wrap">
                                <h4>Experience</h4>
                                {!! nl2br($job->experience) !!}
                            </div>

                            <div class="single_wrap">
                                <h4>Benefits</h4>
                                {!! nl2br($job->benefits) !!}
                            </div>

                            <div class="single_wrap">
                                <h4>keywords</h4>
                                {!! nl2br($job->keywords) !!}
                            </div>

                            <div class="border-bottom"></div>
                            <div class="pt-3 text-end">
                                @if (Auth::check())
                                    <form action="{{ route('save-job') }}" method="POST" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $job->id }}">
                                        <button type="submit" class="btn btn-secondary">Save</button>
                                    </form>
                                    <form action="{{ route('apply-job') }}" method="POST" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $job->id }}">
                                        <button type="submit" class="btn btn-primary">Apply</button>
                                    </form>
                                @else
                                    <a href="javascript:void(0);" class="btn btn-secondary disabled">Login to Save</a>
                                    <a href="javascript:void(0);" class="btn btn-primary disabled">Login to Apply</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- Job Summary and Company Details -->
                    <div class="card shadow border-0">
                        <div class="job_sumary">
                            <div class="summery_header pb-1 pt-4">
                                <h3>Job Summary</h3>
                            </div>
                            <div class="job_content pt-3">
                                <ul>
                                    <li>Published on:
                                        <span>{{ \Carbon\Carbon::parse($job->created_at)->format('d M, Y') }}</span>
                                    </li>
                                    <li>Vacancy: <span>{{ $job->vacancy }}</span></li>
                                    @if (!empty($job->salary))
                                        <li>Salary: <span>{{ $job->salary }}</span></li>
                                    @endif
                                    <li>Location: <span>{{ $job->location }}</span></li>
                                    <li>Job Nature: <span>{{ $job->JobType->name }}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow border-0 my-4">
                        <div class="job_sumary">
                            <div class="summery_header pb-1 pt-4">
                                <h3>Company Details</h3>
                            </div>
                            <div class="job_content pt-3">
                                <ul>
                                    <li>Name: <span>{{ $job->company_name }}</span></li>
                                    <li>Location: <span>{{ $job->company_location }}</span></li>
                                    @if (!empty($job->company_website))
                                        <li>Website: <span><a
                                                    href="{{ $job->company_website }}">{{ $job->company_website }}</a></span>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if (Auth::user())

                @if (Auth::user()->id == $job->user_id)
                    <div class="row pt-7">
                        <div class="col-md-12">
                            <div class="card shadow border-0">
                                <div class="card-header">
                                    <h4>Applicants</h4>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Mobile</th>
                                                <th>Applied Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($applications as $application)
                                                <tr>
                                                    <td>{{ $application->user->name }}</td>
                                                    <td>{{ $application->user->email }}</td>
                                                    <td>{{ $application->user->mobile }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($application->created_at)->format('d M, Y') }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @if ($applications->isEmpty())
                                        <p class="text-center">No applicants yet.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif


        </div>
    </section>
@endsection

@section('customJs')
@endsection
