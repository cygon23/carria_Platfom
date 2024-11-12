@extends('front.layouts.app')

@section('main')
<div class="container">
    <h2>All Companies</h2>

    <!-- Loop through each company in the paginated collection -->
    @foreach($companies as $company)
        <div class="row mb-4">
            <!-- Company Details -->
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <!-- Use Storage::url() to get the correct image URL -->
                    <img src="{{ Storage::url($company->image_path) }}" alt="{{ $company->name }}" class="card-img-top"
                         style="height: 300px; object-fit: cover;">
                            {{-- <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $company->name }}" class="card-img-top"
         style="height: 300px; object-fit: cover;"> --}}
                    <div class="card-body">
                        <h3 class="card-title">{{ $company->name }}</h3>
                        <p class="card-text"><strong>About:</strong> {{ $company->about }}</p>
                        <p class="card-text"><strong>What We Offer:</strong> {{ $company->offer }}</p>
                        <p class="card-text"><strong>Location:</strong> {{ $company->location }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Job Positions for this Company -->
        <div class="row">
            <h4>Available Job Positions at {{ $company->name }}</h4>
            @foreach($company->jobPositions as $job)
                <div class="col-md-4">
                    <div class="card shadow-sm mb-4">
                        <!-- Use Storage::url() to get the correct job image URL -->
                        <img src="{{ Storage::url($job->image_path) }}" alt="{{ $job->title }}" class="card-img-top"
                             style="height: 200px; object-fit: cover;">
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

    <!-- Pagination links -->
    <div class="mt-4">
        {{ $companies->links() }}

    </div>
</div>
@endsection
