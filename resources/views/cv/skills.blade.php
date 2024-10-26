@extends('front.layouts.app')


@section('main')

<div class="container my-5">
    <h2 class="text-center mb-4">Add Skills</h2>
    <form action="{{ route('cv.skills.store') }}" method="POST" class="card p-4 shadow-sm">
        @csrf

        <div class="form-group mb-3">
            <label for="cv_basic_info_id" class="form-label">Basic Information</label>
            <select name="cv_basic_info_id" class="form-control" required>
                <option value="">Select Category</option>
                @foreach($basicInfos as $basicInfo)
                    <option value="{{ $basicInfo->id }}">{{ $basicInfo->first_name }} </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="skill_name" class="form-label">Skill Name</label>
            <input type="text" name="skill_name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Next: Awards</button>
    </form>
</div>

@endsection
