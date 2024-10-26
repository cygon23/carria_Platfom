@extends('front.layouts.app')




@section('main')
<div class="container my-5">
    <h2 class="text-center mb-4">Basic Information</h2>
    <form action="{{ route('cv.basic.store') }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">
        @csrf

        <!-- Photo -->
        <div class="form-group mb-3">
            <label for="photo" class="form-label">Profile Photo</label>
            <input type="file" name="photo" class="form-control">
        </div>

        <!-- First Name -->
        <div class="form-group mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" name="first_name" class="form-control" required>
        </div>

        <!-- Last Name -->
        <div class="form-group mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" name="last_name" class="form-control" required>
        </div>

        <!-- Email -->
        <div class="form-group mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <!-- Phone Number -->
        <div class="form-group mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="text" name="phone" class="form-control" required>
        </div>

        <!-- Description -->
        <div class="form-group mb-4">
            <label for="description" class="form-label">Profile Description</label>
            <textarea name="description" class="form-control" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary w-100">Next: Education</button>
    </form>
</div>
@endsection
