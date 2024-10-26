@extends('front.layouts.app')



@section('main')
<div class="container my-5">
    <h2 class="text-center mb-4">Education</h2>
    <form action="{{ route('cv.education.store') }}" method="POST" class="card p-4 shadow-sm">
        @csrf

        <div class="form-group mb-3">
            <label for="degree" class="form-label">Degree</label>
            <input type="text" name="degree" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="institution_name" class="form-label">Institution</label>
            <input type="text" name="institution_name" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="field_of_study" class="form-label">Field of Study</label>
            <input type="text" name="field_of_study" class="form-control">
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
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4"></textarea>
        </div>

        <button type="submit" class="btn btn-primary w-100">Next: Experience</button>
    </form>
</div>

@endsection
