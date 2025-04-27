@extends('front.layouts.app')

@section('main')
    <section class="section-5">
        <div class="container my-5">
            <div class="py-lg-2">&nbsp;</div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-5">
                    <div class="card shadow border-0 p-5">
                        <h1 class="h3">Register</h1>
                        @include('front.layouts._message')
                        <form action="" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="mb-2">Name*</label>
                                <input type="text" name="name" value="{{ old('name') }}" id="name"
                                    class="form-control" placeholder="Enter Name">
                                @error('name')
                                    <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="mb-2">Email*</label>
                                <input type="text" name="email" value="{{ old('email') }}" id="email"
                                    class="form-control" placeholder="Enter Email">
                                @error('email')
                                    <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="mb-2">Password*</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Enter Password">
                                @error('password')
                                    <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="mb-2">Confirm Password*</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control" placeholder="Confirm Password">
                                @error('password_confirmation')
                                    <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                                @enderror
                            </div>
                            <button class="btn btn-primary mt-2">Register</button>
                        </form>

                        <!-- Social Register Options -->
                        <div class="text-center mt-4">
                            <p>Or register with</p>
                            <div class="d-flex justify-content-center">
                                <!-- LinkedIn Register Button -->
                                <a href=" #" class="btn btn-linkedin mx-2">
                                    <i class="fab fa-linkedin"></i> LinkedIn
                                </a>
                                <!-- Google Register Button -->
                                <a href="{{ url('/auth/google/redirect') }}" class="btn btn-google mx-2">
                                    <i class="fab fa-google"></i> Google
                                </a>
                            </div>
                        </div>
                        <div class="mt-4 text-center">
                            <p>Have an account? <a href="{{ url('login') }}">Login</a></p>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
@endsection


@section('customJs')
    <script>
        $('#registration').submit(function(e) {
            e.preventDefault();
        });
    </script>
@endsection
