@extends('front.layouts.app')

@section('main')
    <div class="d-flex flex-column min-vh-100">

        <!-- Display Success/Error Messages -->
        <div class="container pt-5">
            <div class="row">
                <div class="col">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Breadcrumb Navigation -->
        <div class="container pt-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('profile') }}">
                                    <i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp;Back
                                </a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="container flex-grow-1">
            <div class="row justify-content-center">
                <!-- Card for Uploading CV -->
                <div class="col-md-6 mb-4">
                    <div class="card shadow-lg text-center">
                        <div class="card-body">
                            <h5 class="card-title">Upload Your CV</h5>
                            <p class="card-text">If you already have a professional CV, upload it here. We will store and
                                review
                                it to ensure it's ready for submission.</p>

                            <!-- Form to upload CV -->
                            <form action="{{ route('cv.upload') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" class="form-control mb-3" name="cv" accept=".pdf" required>
                                <button type="submit" class="btn btn-primary">Upload CV</button>
                            </form>

                            @if (Auth::user()->cv_url)
                                <div class="mt-3">
                                    <a href="{{ asset(Auth::user()->cv_url) }}" class="btn btn-success">Download Your CV</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Card for Creating CV -->
                <div class="col-md-6 mb-4">
                    <div class="card shadow-lg text-center">
                        <div class="card-body">
                            <h5 class="card-title">Create a New CV</h5>
                            <p class="card-text">Don’t have a CV? Use our CV builder to create a professional CV that stands
                                out.</p>
                            <a href="{{ route('cv.basic') }}" class="btn btn-success">Create CV</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
