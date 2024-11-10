@extends('front.layouts.app')

@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Admin Dashboard</li>
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

                <!-- Login Activity Table -->
                <div class="card border-0 shadow mb-4">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-history"></i> Login Activity</h5>
                        <p class="text-muted mb-4">Here you can view all login attempts made by users, including successes and failures.</p>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>User Email</th>
                                        <th>IP Address</th>
                                        <th>Status</th>
                                        <th>Timestamp</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($loginActivities as $activity)
                                    <tr>
                                        <td>{{ $activity->email }}</td>
                                        <td>{{ $activity->ip_address }}</td>
                                        <td>
                                            @if($activity->success == 1)
                                                <span class="badge bg-success">Success</span>
                                            @else
                                                <span class="badge bg-danger">Failure</span>
                                            @endif
                                        </td>
                                        <td>{{ $activity->created_at->format('Y-m-d H:i') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        {{-- <div class="d-flex justify-content-end">
                            {{ $loginActivities->links() }}
                        </div> --}}
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
