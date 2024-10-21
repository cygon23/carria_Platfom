@extends('front.layouts.app')


@section('main')
    <div class="explore-page container my-5">
        <!-- Hero Section: Eye-catching with a Background Image or Video -->
        <div class="hero-section text-center text-black py-5"
            style="background-image: url('https://via.placeholder.com/1600x900'); background-size: cover; background-position: center;">
            <h1 class="display-4 font-weight-bold">Explore Your Future with Us</h1>
            <p class="lead mb-4">We help you discover your dream career, innovate, and connect with experts.</p>
            <a href="#about-us" class="btn btn-primary btn-lg">Learn More <i class="fas fa-arrow-right ml-2"></i></a>
        </div>

        <!-- Section: What We Offer -->
        <section id="about-us" class="my-5">
            <h2 class="text-center mb-4">What We Offer</h2>
            <div class="row text-center">
                <!-- Career Training -->
                <div class="col-md-4 mb-4">
                    <div class="offer-card p-4 bg-light rounded shadow-sm">
                        <i class="fas fa-chalkboard-teacher fa-3x text-primary mb-3"></i>
                        <h5 class="font-weight-bold">Career Training</h5>
                        <p>We offer personalized career training programs to help you excel in your field.</p>
                        <a href="#" class="btn btn-outline-primary">Learn More</a>
                    </div>
                </div>

                <!-- Support for Innovation -->
                <div class="col-md-4 mb-4">
                    <div class="offer-card p-4 bg-light rounded shadow-sm">
                        <i class="fas fa-lightbulb fa-3x text-primary mb-3"></i>
                        <h5 class="font-weight-bold">Support Innovation</h5>
                        <p>We encourage creative ideas and support innovation with guidance and resources.</p>
                        <a href="#" class="btn btn-outline-primary">Learn More</a>
                    </div>
                </div>

                <!-- Mentorship Program -->
                <div class="col-md-4 mb-4">
                    <div class="offer-card p-4 bg-light rounded shadow-sm">
                        <i class="fas fa-user-graduate fa-3x text-primary mb-3"></i>
                        <h5 class="font-weight-bold">Mentorship Program</h5>
                        <p>Connect with experienced mentors who guide you through your career path.</p>
                        <a href="#" class="btn btn-outline-primary">Learn More</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: Join the Community (Interactive/Engagement) -->
        <section id="community" class="py-5 bg-primary text-black">
            <div class="text-center mb-4">
                <h2>Join Our Community</h2>
                <p>Meet people, share ideas, and grow together.</p>
            </div>
            <div class="row">
                <div class="col-md-6 text-center">
                    <img src="{{ url('assets/images/banner5.jpg') }}" alt="Community Image" class="img-fluid rounded mb-4">
                </div>
                <div class="col-md-6">
                    <h3>Why Join Us?</h3>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check-circle text-white mr-2"></i> Access to a wide network of professionals
                        </li>
                        <li><i class="fas fa-check-circle text-white mr-2"></i> Free career guidance and mentorship</li>
                        <li><i class="fas fa-check-circle text-white mr-2"></i> Be part of innovation and creativity hubs
                        </li>
                    </ul>
                    <a href="#" class="btn btn-outline-light mt-3">Join Now</a>
                </div>
            </div>
        </section>

        <!-- Section: Available Jobs (Company and Job Listings) -->
        <section id="partners" class="my-5">
            <h2 class="text-center mb-4">Our Partners</h2>
            <div class="row text-center">
                <!-- Partner Card: Ubuntu Hub -->
                <div class="col-md-4 mb-4">
                    <div class="partner-card p-4 bg-light rounded shadow-sm">
                        <img src="https://via.placeholder.com/150" alt="Ubuntu Hub Logo" class="img-fluid mb-3">
                        <h5 class="font-weight-bold">Ubuntu Hub</h5>
                        <p>Supporting community-driven innovation and technology solutions in Africa.</p>
                        <a href="#" class="btn btn-outline-primary">Learn More</a>
                    </div>
                </div>

                <!-- Partner Card: IAA Business Startup Center -->
                <div class="col-md-4 mb-4">
                    <div class="partner-card p-4 bg-light rounded shadow-sm">
                        <img src="https://via.placeholder.com/150" alt="IAA Business Startup Center Logo"
                            class="img-fluid mb-3">
                        <h5 class="font-weight-bold">IAA Business Startup Center</h5>
                        <p>Empowering entrepreneurs and nurturing startups to success in Tanzania.</p>
                        <a href="#" class="btn btn-outline-primary">Learn More</a>
                    </div>
                </div>

                <!-- Partner Card: Ishi -->
                <div class="col-md-4 mb-4">
                    <div class="partner-card p-4 bg-light rounded shadow-sm">
                        <img src="https://via.placeholder.com/150" alt="Ishi Logo" class="img-fluid mb-3">
                        <h5 class="font-weight-bold">Ishi</h5>
                        <p>Promoting sustainable development and community wellness across East Africa.</p>
                        <a href="#" class="btn btn-outline-primary">Learn More</a>
                    </div>
                </div>
            </div>

            <div class="row text-center">
                <!-- Partner Card: JA Africa -->
                <div class="col-md-4 mb-4">
                    <div class="partner-card p-4 bg-light rounded shadow-sm">
                        <img src="https://via.placeholder.com/150" alt="JA Africa Logo" class="img-fluid mb-3">
                        <h5 class="font-weight-bold">JA Africa</h5>
                        <p>Inspiring and preparing Africa’s youth for economic success through entrepreneurship programs.
                        </p>
                        <a href="#" class="btn btn-outline-primary">Learn More</a>
                    </div>
                </div>

                <!-- Partner Card: Niajiri -->
                <div class="col-md-4 mb-4">
                    <div class="partner-card p-4 bg-light rounded shadow-sm">
                        <img src="https://via.placeholder.com/150" alt="Niajiri Logo" class="img-fluid mb-3">
                        <h5 class="font-weight-bold">Niajiri</h5>
                        <p>Connecting talented individuals with job opportunities in Kenya and across Africa.</p>
                        <a href="#" class="btn btn-outline-primary">Learn More</a>
                    </div>
                </div>
            </div>
        </section>


        <!-- Section: Call to Action -->
        <section class="text-center my-5 py-5 bg-light">
            <h2>Ready to Transform Your Career?</h2>
            <p>Start exploring the countless opportunities and let us help you reach your goals.</p>
            <a href="#" class="btn btn-primary btn-lg">Get Started</a>
        </section>
    </div>
@endsection
