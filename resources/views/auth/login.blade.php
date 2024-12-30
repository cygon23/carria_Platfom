@extends('front.layouts.app')

@section('main')
    <section class="section-5">
        <div class="container my-5">
            <div class="py-lg-2">&nbsp;</div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-5">
                    <div class="card shadow border-0 p-5">
                        <h1 class="h3">Login</h1>
                        @include('front.layouts._message')
                        <form action="{{ route('login.authenticate') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="mb-2">Email*</label>
                                <input type="text" name="email" id="email" value="{{ old('email') }}"
                                    class="form-control" placeholder="example@example.com">
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
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" value="true"
                                        id="rememberMe">
                                    <label class="form-check-label" for="rememberMe">Remember me</label>
                                </div>
                            </div>
                            <div class="justify-content-between d-flex">
                                <button class="btn btn-primary mt-2">Login</button>
                                <a href="{{ url('password-forgot') }}" class="mt-3">Forgot Password?</a>
                            </div>

                             <div class="recapture">
                                  {!! htmlFormSnippet() !!}
                             </div>
                        </form>

                        <!-- Social Login Options -->
                        <div class="text-center mt-4">
                            <p>Or login with</p>
                            <div class="d-flex justify-content-center">
                                <!-- LinkedIn Login Button -->
                                <a href="{{'auth/linkedin-openid/redirect'}}" class="btn btn-linkedin mx-2">
                                    <i class="fab fa-linkedin"></i> LinkedIn
                                </a>
                                <!-- Google Login Button -->
                                <a href="{{ url('/auth/google/redirect') }}" class="btn btn-google mx-2">
                                    <i class="fab fa-google"></i> Google
                                </a>
                            </div>
                        </div>
                        <div class="mt-4 text-center">
                            <p>Don't have an account? <a href="{{ url('register') }}">Register</a></p>
                        </div>
                    </div>

                </div>
            </div>
            <div class="py-lg-5">&nbsp;</div>
        </div>
    </section>
@endsection
