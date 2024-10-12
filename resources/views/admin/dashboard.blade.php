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
                    <div class="card border-0 shadow mb-4">
                        <div class="card-body">
                            <h5 class="mt-3 pb-0">
                                <i class="fas fa-user-shield"></i> Welcome, <strong>{{ Auth::user()->name }}</strong>!
                            </h5>
                            <p class="text-muted">You are logged in as an admin.</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
