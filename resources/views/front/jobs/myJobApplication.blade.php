@extends('front.layouts.app')

@section('main')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active">My Jobs</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    @include('auth.sidebar')
                </div>
                <div class="col-lg-9">
                    <div class="card border-0 shadow mb-4 p-3">
                        <div class="card-body card-form">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3 class="fs-4 mb-1">Jobs Applied</h3>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="bg-light">
                                        <tr>
                                            <th scope="col">Title</th>
                                            <th scope="col">Applied Date</th>
                                            <th scope="col">Applicants</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="border-0">
                                        @if ($jobApplications->isNotEmpty())
                                            @foreach ($jobApplications as $jobApplication)
                                                <tr class="active">
                                                    <td>
                                                        <div class="job-name fw-500">
                                                            {{ $jobApplication->title }}</div> <!-- Access the job title -->
                                                        <div class="info1">{{ $jobApplication->location }}
                                                            <!-- Access location -->
                                                        </div>
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($jobApplication->applied_date)->format('d M, Y') }}
                                                    </td>
                                                    <td>
                                                        @php
                                                            // Get the job ID for the current job application
                                                            $jobId = $jobApplication->job_id;
                                                            // Fetch the total applicants count for this job
                                                            $applicantCount = $totalJobCounts->get($jobId);
                                                        @endphp
                                                        {{-- Display the applicant count, defaulting to 0 if not found --}}
                                                        {{ $applicantCount ? $applicantCount->total_applicants : 0 }}
                                                        Applicants
                                                    </td>
                                                    <td>
                                                        @if ($jobApplication->status == 1)
                                                            <div class="job-status text-capitalize">Active</div>
                                                        @else
                                                            <div class="job-status text-capitalize">Blocked</div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="action-dots float-end">
                                                            <button href="#" class="btn" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li><a class="dropdown-item"
                                                                        href="{{ route('/account/jobs/detail', $jobApplication->job_id) }}">
                                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                                        View</a></li>
                                                                {{-- <li><a class="dropdown-item"
                                                                        href="{{ route('edit-job', $jobApplication->job_id) }}"><i
                                                                            class="fa fa-edit" aria-hidden="true"></i>
                                                                        Edit</a></li> --}}

                                                                <li>
                                                                    <form
                                                                        action="{{ route('delete-Appliedjob', $jobApplication->job_id) }}"
                                                                        method="POST" style="display: inline;">
                                                                        @csrf
                                                                        @method('POST')
                                                                        <button type="submit" class="dropdown-item"
                                                                            style="border: none; background: none; cursor: pointer;">
                                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                                            Remove
                                                                        </button>
                                                                    </form>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5" class="text-center">No jobs found.</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div>
                            {{ $jobApplications->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
