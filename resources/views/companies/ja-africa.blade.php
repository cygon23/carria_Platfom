@extends('front.layouts.app')


@section('main')
    <div class="container">
        <div class="row">
            <!-- Company Details -->
            <div class="col-md-12 mb-4">
                <div class="card shadow-sm">
                    <img src="{{ url('assets/images/jobs/ia.jpg') }}" alt="JA Africa" class="card-img-top"
                        style="height: 300px; object-fit: cover;">
                    <div class="card-body">
                        <h3 class="card-title">JA Africa</h3>
                        <p class="card-text">
                            <strong>About:</strong> JA Africa is a global leader in cloud computing and AI solutions,
                            helping businesses around the world scale through cutting-edge technology.
                        </p>
                        <p class="card-text">
                            <strong>What We Offer:</strong> We offer innovative cloud solutions, AI-powered analytics, and a
                            variety of enterprise software tools.
                        </p>
                        <p class="card-text">
                            <strong>Location:</strong> Arusha, TZ
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Available Job Positions as Cards -->
        <div class="row">
            <h4 class="mb-4">Available Job Positions</h4>

            <!-- Job 1 -->
            <div class="col-md-4">
                <div class="card shadow-sm mb-4">
                    <img src="{{ url('assets/images/com/ai.jpg') }}" alt="Cloud Engineer" class="card-img-top"
                        style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Cloud Engineer</h5>
                        <p class="card-text">Join our team of cloud engineers to develop and scale cloud infrastructure.</p>
                        <a href="{{ url('/account/jobs') }}" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i> Apply Now
                        </a>
                    </div>
                </div>
            </div>

            <!-- Job 2 -->
            <div class="col-md-4">
                <div class="card shadow-sm mb-4">
                    <img src="{{ url('assets/images/com/ai1.jpg') }}" alt="AI Research Specialist" class="card-img-top"
                        style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">AI Research Specialist</h5>
                        <p class="card-text">Work on cutting-edge AI projects and help innovate solutions across industries.
                        </p>
                        <a href="#" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i> Apply Now
                        </a>
                    </div>
                </div>
            </div>

            <!-- Job 3 (Add more job positions similarly) -->
            <div class="col-md-4">
                <div class="card shadow-sm mb-4">
                    <img src="{{ url('assets/images/com/ai2.jpg') }}" alt="Data Scientist" class="card-img-top"
                        style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Data Scientist</h5>
                        <p class="card-text">Analyze big data and build models to provide insights to our clients.</p>
                        <a href="#" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i> Apply Now
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
