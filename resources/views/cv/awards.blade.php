@extends('front.layouts.app')



@section('main')
<div class="container my-5">
    <h2 class="text-center mb-4">Add Awards</h2>
    <form action="{{ route('cv.awards.store') }}" method="POST" class="card p-4 shadow-sm">
        @csrf

        {{-- <div class="form-group mb-3">
            <label for="cv_basic_info_id" class="form-label">Basic Information</label>
            <select name="cv_basic_info_id" class="form-control" required>
                <option value="">Select Basic Info</option>
                @foreach($basicInfos as $basicInfo)
                    <option value="{{ $basicInfo->id }}">{{ $basicInfo->first_name }} {{ $basicInfo->last_name }}</option>
                @endforeach
            </select>
        </div> --}}

        <div class="form-group mb-3">
            <label for="award_name" class="form-label">Award Name</label>
            <input type="text" name="award_name" class="form-control" placeholder="Enter the name of the award" required>
        </div>

        <div class="form-group mb-3">
            <label for="awarding_institution" class="form-label">Awarding Institution</label>
            <input type="text" name="awarding_institution" class="form-control" placeholder="Enter the name of the institution" required>
        </div>

        <div class="form-group mb-3">
            <label for="date_awarded" class="form-label">Date Awarded</label>
            <input type="date" name="date_awarded" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3" placeholder="Provide a brief description of the award" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary w-100">Add Awards</button>
    </form>
</div>

@endsection
