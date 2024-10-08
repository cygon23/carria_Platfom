@extends('front.layouts.app')

@section('main')
    <section class="section-404 py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <div class="card border-0 shadow p-5">
                        <div class="card-body">
                            <h1 class="display-4 text-danger">404</h1>
                            <h2 class="mb-4">Oops! Page Not Found</h2>
                            <p class="lead mb-4">The page you're looking for doesn't exist, or may have been moved.</p>
                            <a href="{{ url('/') }}" class="btn btn-primary">Go Back to Homepage</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
