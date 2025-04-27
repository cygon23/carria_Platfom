@extends('front.layouts.app')

@section('main')

<div class="container" style="padding-top: 50px">
    <!-- Search Bar -->
    <form method="GET" action="{{ route('admin.submittedCvs') }}" class="mb-3">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by user name...">
        <button type="submit" class="btn btn-primary mt-2">Search</button>
    </form>


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>S/N</th>
                <th>User Name</th>
                <th>CV NAME</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usersWithCVs as $index => $user)
            <tr>
                <td>{{ $usersWithCVs->firstItem() + $index }}</td>
                <td>{{ $user->name }}</td>
                @php
                 $filename = basename($user->cv_url);
                 $cleanName = preg_replace('/^\d+_/', '', pathinfo($filename, PATHINFO_FILENAME));
               @endphp
             <td>{{ $cleanName }}</td>
              <td>
    <a href="{{ Storage::url($user->cv_url) }}" target="_blank" class="btn btn-primary btn-sm">
        View CV
    </a>
    <form action="{{ route('cv.delete') }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this CV?')">
            Delete
        </button>
    </form>
</td>

            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center">
        {{ $usersWithCVs->appends(request()->query())->links() }}
    </div>
</div>
@endsection
