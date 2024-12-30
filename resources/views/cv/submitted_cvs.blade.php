@extends('front.layouts.app')


@section('main')
<div class="container">
    <!-- Search Bar -->
    <form method="GET" action="{{ route('admin.submittedCvs') }}" class="mb-3">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by file name...">
        <button type="submit" class="btn btn-primary mt-2">Search</button>
    </form>

    <!-- CV List Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>File Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($filesPaginator as $index => $file)
            <tr>
                <td>{{ $filesPaginator->firstItem() + $index }}</td>
                <td>{{ basename($file) }}</td>
                <td>
                    <a href="{{ Storage::url('cvs/' . $file) }}" target="_blank" class="btn btn-info btn-sm">
                        View CV
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center">
        {{ $filesPaginator->appends(request()->query())->links() }}
    </div>
</div>




@endsection
