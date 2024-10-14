@extends('front.layouts.app')

@section('main')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard /List</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    @include('admin.sidebar-adm')
                </div>
                <div class="col-lg-9">
                    @include('front.layouts._message')
                    <div class="card border-0 shadow mb-4">
                        <div class="card-body text-center">

                            <div class="card-body card-form">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h3 class="fs-4 mb-1">Users</h3>
                                    </div>
                                    <div style="margin-top: -10px;">

                                    </div>

                                </div>
                                <div class="table-responsive">
                                    <table class="table ">
                                        <thead class="bg-light">
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Designation</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="border-0">
                                            @if ($users->isNotEmpty())
                                                @foreach ($users as $user)
                                                    <tr class="active">
                                                        <td>
                                                            <div class="job-name fw-500">{{ $user->name }}</div>
                                                        </td>
                                                        <td>
                                                            <div class="info1">{{ $user->email }}</div>
                                                        </td>
                                                        <td>{{ $user->mobile }}
                                                        </td>
                                                        <td>
                                                            <div class="action-dots">
                                                                <button href="#" class="btn"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li><a class="dropdown-item"
                                                                            href="{{ route('dashboard.edit', $user->id) }}"><i
                                                                                class="fa fa-edit" aria-hidden="true"></i>
                                                                            Edit</a></li>

                                                                    <li>
                                                                        <form
                                                                            action="{{ route('dashboard.delete', $user->id) }}"
                                                                            method="POST" style="display: inline;">
                                                                            @csrf
                                                                            @method('POST')
                                                                            <button type="submit" class="dropdown-item"
                                                                                style="border: none; background: none; cursor: pointer;">
                                                                                <i class="fa fa-edit"
                                                                                    aria-hidden="true"></i>
                                                                                Delete
                                                                            </button>
                                                                        </form>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="5" class="text-center">No jobs found.</td>
                                                </tr>
                                            @endif
                                        </tbody>

                                    </table>
                                </div>
                                <div>
                                    {{ $users->links() }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
