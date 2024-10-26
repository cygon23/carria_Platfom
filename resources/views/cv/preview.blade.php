@extends('front.layouts.app')



@section('main')

{{-- <div class="container my-5">
    <h2 class="text-center mb-4">CV Preview</h2>

    <div class="card p-4 shadow-sm">
        <h3>{{ $basicInfo->first_name }} {{ $basicInfo->last_name }}</h3>
        <p><strong>Email:</strong> {{ $basicInfo->email }}</p>
        <p><strong>Phone:</strong> {{ $basicInfo->phone }}</p>
        <p><strong>Description:</strong> {{ $basicInfo->description }}</p>

        <hr>

        <h4>Education</h4>
        @if($basicInfo->educations->isNotEmpty())
            <ul>
                @foreach($basicInfo->educations as $education)
                    <li>{{ $education->degree }} at {{ $education->institution_name }} ({{ $education->start_date }} - {{ $education->end_date }})</li>
                @endforeach
            </ul>
        @else
            <p>No education records available.</p>
        @endif

        <hr>

        <h4>Experience</h4>
        @if($basicInfo->experiences->isNotEmpty())
            <ul>
                @foreach($basicInfo->experiences as $experience)
                    <li>{{ $experience->job_title }} at {{ $experience->company_name }} ({{ $experience->start_date }} - {{ $experience->end_date }})</li>
                @endforeach
            </ul>
        @else
            <p>No experience records available.</p>
        @endif

        <hr>

        <h4>Skills</h4>
        @if($basicInfo->skills->isNotEmpty())
            <ul>
                @foreach($basicInfo->skills as $skill)
                    <li>{{ $skill->skill_name }}</li>
                @endforeach
            </ul>
        @else
            <p>No skills records available.</p>
        @endif

        <hr>

        <h4>Awards</h4>
        @if($basicInfo->awards->isNotEmpty())
            <ul>
                @foreach($basicInfo->awards as $award)
                    <li>{{ $award->award_name }} from {{ $award->awarding_institution }} ({{ $award->date_awarded }})</li>
                @endforeach
            </ul>
        @else
            <p>No awards records available.</p>
        @endif
    </div>
</div> --}}



@endsection
