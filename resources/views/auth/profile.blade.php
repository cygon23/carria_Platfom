@extends('front.layouts.app')

@section('main')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Account Settings</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    @include('auth.sidebar')
                </div>
                <div class="col-lg-9">
                    <!-- Profile Update Form -->
                    <div class="card border-0 shadow mb-4">
                        @include('front.layouts._message')
                        <form action="{{ route('updateProfile') }}" method="POST">
                            @csrf <!-- CSRF protection -->
                            <div class="card-body p-4">
                                <h3 class="fs-4 mb-1">My Profile</h3>
                                <div class="mb-4">
                                    <label for="name" class="mb-2">Name*</label>
                                    <input type="text" name="name" placeholder="Enter Name" class="form-control"
                                        value="{{ old('name', $user->name) }}">
                                    @error('name')
                                        <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                                        <!-- Use $message for error messages -->
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="email" class="mb-2">Email*</label>
                                    <input type="email" name="email" placeholder="Enter Email" class="form-control"
                                        value="{{ old('email', $user->email) }}">
                                    @error('email')
                                        <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                                        <!-- Use $message for error messages -->
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="designation" class="mb-2">Designation*</label>
                                    <input type="text" name="designation" placeholder="Designation" class="form-control"
                                        value="{{ old('designation', $user->designation) }}">
                                </div>
                                <div class="mb-4">
                                    <label for="mobile" class="mb-2">Mobile*</label>
                                    <input type="text" name="mobile" placeholder="Mobile" class="form-control"
                                        value="{{ old('mobile', $user->mobile) }}">
                                    @error('mobile')
                                        <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                                        <!-- Use $message for error messages -->
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer p-4">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>


                    <!-- Password Change Form -->
                    <div class="card border-0 shadow mb-4">

                        <form action="{{ route('password-update') }}" method="POST">
                            @csrf
                            <div class="card-body p-4">
                                <h3 class="fs-4 mb-1">Change Password</h3>
                                <div class="mb-4">
                                    <label for="old_password" class="mb-2">Old Password*</label>
                                    <input type="password" name="old_password" placeholder="Old Password"
                                        class="form-control">
                                    @error('old_password')
                                        <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                                        <!-- Use $message for error messages -->
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="new_password" class="mb-2">New Password*</label>
                                    <input type="password" name="new_password" placeholder="New Password"
                                        class="form-control">
                                    @error('new_password')
                                        <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                                        <!-- Use $message for error messages -->
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="confirm_password" class="mb-2">Confirm Password*</label>
                                    <input type="password" name="confirm_password" placeholder="Confirm Password"
                                        class="form-control">
                                    @error('confirm_password')
                                        <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                                        <!-- Use $message for error messages -->
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer p-4">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
