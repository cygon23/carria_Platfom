@extends('front.layouts.app')

@section('main')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">List</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    @include('admin.sidebar-adm')
                </div>
                <div class="col-lg-9">
                    @include('front.layouts._message')
                    <div class="card border-0 shadow mb-4">
                        <div class="card-body text-center">

                            <div class="card-body card-form">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h3 class="fs-4 mb-1">Jobs</h3>
                                    </div>
                                    <div style="margin-top: -10px;">

                                    </div>

                                </div>
                                <div class="table-responsive">
                                    <table class="table ">
                                        <thead class="bg-light">
                                            <tr>
                                                <th scope="col">Title</th>
                                                <th scope="col">Created By</th>
                                                <th scope="col">status</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="border-0">
                                            @if ($jobs->isNotEmpty())
                                                @foreach ($jobs as $job)
                                                    <tr>
                                                        <td>
                                                            <p> {{ $job->title }}</p>
                                                            @if ($job->applicant_count > 0)
                                                                <p>Total Applicants: {{ $job->applicant_count }}</p>
                                                            @else
                                                                <p>Total Applicants: 0</p>
                                                            @endif
                                                        </td>
                                                        <td>{{ $job->user_name }}</td>
                                                        <td>
                                                            @if ($job->status == 1)
                                                                <p class="text-success">Active</p>
                                                            @else
                                                                <p class="text-danger">Blocked</p>
                                                            @endif
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($job->created_at)->format('d M,Y ') }}
                                                        </td>
                                                        <td>
                                                            <div class="action-dots">
                                                                <button href="#" class="btn"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li><a class="dropdown-item"
                                                                            href="{{ route('dashboard.Jobedit', $job->id) }}"><i
                                                                                class="fa fa-edit" aria-hidden="true"></i>
                                                                            Edit</a></li>

                                                                    <li>
                                                                        <form
                                                                            action="{{ route('dashboard.deleteJob', $job->id) }}"
                                                                            method="POST" style="display: inline;">
                                                                            @csrf
                                                                            <button type="submit" class="dropdown-item"
                                                                                style="border: none; background: none; cursor: pointer;">
                                                                                <i class="fa fa-edit"
                                                                                    aria-hidden="true"></i>
                                                                                Delete
                                                                            </button>
                                                                        </form>

                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>

                                    </table>
                                </div>
                                <div>
                                    {{ $jobs->links() }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
