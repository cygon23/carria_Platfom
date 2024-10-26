@extends('front.layouts.app')



@section('main')
<div class="container my-5">
    <h2 class="text-center mb-4">Experience</h2>
    <form action="{{ route('cv.experience.store') }}" method="POST" class="card p-4 shadow-sm">
        @csrf

        <div class="form-group mb-3">
            <label for="job_title" class="form-label">Job Title</label>
            <input type="text" name="job_title" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="company_name" class="form-label">Company Name</label>
            <input type="text" name="company_name" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" name="location" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" name="start_date" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="end_date" class="form-label">End Date</label>
            <input type="date" name="end_date" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="description" class="form-label">Description of Responsibilities</label>
            <textarea name="description" class="form-control" rows="4" placeholder="Briefly describe your responsibilities and achievements"></textarea>
        </div>

        <button type="submit" class="btn btn-primary w-100">Next: Skills</button>
    </form>
</div>
@endsection
