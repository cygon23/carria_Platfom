@extends('front.layouts.app')




@section('main')
    <h2>Basic Information</h2>
    <form action="#" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Photo -->
        <div class="form-group">
            <label for="photo">Profile Photo</label>
            <input type="file" name="photo" class="form-control">
        </div>

        <!-- First Name -->
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" class="form-control" required>
        </div>

        <!-- Last Name -->
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" class="form-control" required>
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <!-- Phone Number -->
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" name="phone" class="form-control" required>
        </div>

        <!-- Description -->
        <div class="form-group">
            <label for="description">Profile Description</label>
            <textarea name="description" class="form-control" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Next: Education</button>
    </form>
    </div>
@endsection
