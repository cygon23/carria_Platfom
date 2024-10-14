@extends('front.layouts.app')

@section('main')
    <section class="section-5">
        <div class="container my-5">
            <div class="py-lg-2">&nbsp;</div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-5">
                    <div class="card shadow border-0 p-5">
                        <h1 class="h3">Reset Password</h1>
                        @include('front.layouts._message')
                        <form action="{{ route('password-reset.email.reqest') }}" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ $tokenString }}">
                            <div class="mb-3">
                                <label for="" class="mb-2">New Password*</label>
                                <input type="password" name="new_password" id="new_password" class="form-control"
                                    placeholder="New password">
                                @error('new_password')
                                    <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                                    <!-- Use $message for error messages -->
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="" class="mb-2">Confirm Password*</label>
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control"
                                    placeholder="Re_type password">
                                @error('confirm_password')
                                    <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                                    <!-- Use $message for error messages -->
                                @enderror
                            </div>
                            <div class="justify-content-between d-flex">
                                <button class="btn btn-primary mt-2">Reset</button>
                            </div>
                        </form>
                    </div>
                    <div class="mt-4 text-center">
                        <p>have an account? <a href="{{ url('login') }}">Login</a></p>
                    </div>
                </div>
            </div>
            <div class="py-lg-5">&nbsp;</div>
        </div>
    </section>
@endsection
