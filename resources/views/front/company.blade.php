@extends('front.layouts.app')



@section('main')
    <div class="container my-5">
        <div class="row">
            <!-- Left Column: Blog Section -->
            <div class="col-md-4">
                <h4 class="mb-4">Company Activities</h4>
                <!-- Blog-like section with activities -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Tech Innovators Hosts Annual Conference</h5>
                        <p class="card-text">Tech Innovators held a groundbreaking AI and cloud computing event attended by
                            industry leaders.</p>
                        <a href="#" class="btn btn-primary p-0">Read More</a>
                    </div>
                </div>

                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Creative Labs Launches New Design Tool</h5>
                        <p class="card-text">Creative Labs introduces a state-of-the-art tool for graphic designers,
                            revolutionizing UI/UX design.</p>
                        <a href="#" class="btn btn-primary p-0">Read More</a>
                    </div>
                </div>

                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Future Enterprises Expands to Europe</h5>
                        <p class="card-text">Future Enterprises is making a global push into sustainable technology,
                            establishing offices in London.</p>
                        <a href="#" class="btn btn-primary p-0">Read More</a>
                    </div>
                </div>
            </div>

            <!-- Right Column: Multiple Companies Section -->
            <div class="col-md-8">
                <h4 class="mb-4">Featured Companies</h4>

                <div class="row">
                    <!-- First Company Card -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm">
                            <img src="{{ url('assets/images/jobs/ia.jpg') }}" alt="Company 1" class="card-img-top"
                                style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">JA Africa</h5>
                                <p class="card-text">
                                    <strong>About:</strong> Global leader in cloud computing and AI solutions.
                                </p>
                                <p class="card-text">
                                    <strong>What We Offer:</strong> Cloud solutions, AI-powered analytics.
                                </p>
                                <p class="card-text">
                                    <strong>Location:</strong> Arusha, TZ
                                </p>
                                <a href="{{ route('company.ja-africa') }}" class="btn btn-primary">
                                    <i class="fas fa-info-circle"></i> Learn More
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Second Company Card -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm">
                            <img src="{{ url('assets/images/jobs/driving.jpg') }}" alt="Company 2" class="card-img-top"
                                style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">Ubuntu Hub</h5>
                                <p class="card-text">
                                    <strong>About:</strong> Specializes in UI/UX development and creative branding.
                                </p>
                                <p class="card-text">
                                    <strong>What We Offer:</strong> Graphic design, branding solutions.
                                </p>
                                <p class="card-text">
                                    <strong>Location:</strong> Arusha, Tz
                                </p>
                                <a href="#" class="btn btn-primary">
                                    <i class="fas fa-info-circle"></i> Learn More
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional companies can be added in the same grid structure -->

                <div class="row">
                    <!-- First Company Card -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm">
                            <img src="{{ url('assets/images/jobs/brodcast.jpg') }}" alt="Company 1" class="card-img-top"
                                style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">Tech Innovators</h5>
                                <p class="card-text">
                                    <strong>About:</strong> Global leader in cloud computing and AI solutions.
                                </p>
                                <p class="card-text">
                                    <strong>What We Offer:</strong> Cloud solutions, AI-powered analytics.
                                </p>
                                <p class="card-text">
                                    <strong>Location:</strong> MWANZA, Tz
                                </p>
                                <a href="#" class="btn btn-primary">
                                    <i class="fas fa-info-circle"></i> Learn More
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Second Company Card -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm">
                            <img src="{{ url('assets/images/jobs/network.jpg') }}" alt="Company 2" class="card-img-top"
                                style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">OCEN Digital</h5>
                                <p class="card-text">
                                    <strong>About:</strong> Specializes in UI/UX development and creative branding.
                                </p>
                                <p class="card-text">
                                    <strong>What We Offer:</strong> Graphic design, branding solutions.
                                </p>
                                <p class="card-text">
                                    <strong>Location:</strong> NAIROBI, KY
                                </p>
                                <a href="#" class="btn btn-primary">
                                    <i class="fas fa-info-circle"></i> Learn More
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
