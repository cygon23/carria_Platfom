@extends('front.layouts.app')

@section('main')
<div class="container">
    <h2>All Companies</h2>

    @foreach($companies as $company)
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <img src="{{ $company->image && $company->image->image_path ? asset($company->image->image_path) : asset('assets/images/default_image.png') }}" alt="Company Image" class="card-img-top" style="height: 300px; object-fit: cover;">

                    <div class="card-body">
                        <h3 class="card-title">{{ $company->name }}</h3>
                        <p class="card-text"><strong>About:</strong> {{ $company->about }}</p>
                        <p class="card-text"><strong>What We Offer:</strong> {{ $company->offer }}</p>
                        <p class="card-text"><strong>Location:</strong> {{ $company->location }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <h4>Available Job Positions at {{ $company->name }}</h4>
            @foreach($company->jobPositions as $job)
                <div class="col-md-4">
                    <div class="card shadow-sm mb-4">
                        {{-- <img src="{{ $job->image_path ? asset($job->image_path) : asset('assets/images/default_image.png') }}" alt="Job Image"> --}}
                        <div class="card-body">
                            <h5 class="card-title">{{ $job->title }}</h5>
                            <p class="card-text">{{ $job->description }}</p>
                            <a href="{{ url('/account/jobs') }}" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i> Apply Now
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach

    <div class="mt-4">
        {{ $companies->links() }}
    </div>
</div>
@endsection
