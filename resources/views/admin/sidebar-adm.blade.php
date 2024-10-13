<div class="card border-0 shadow mb-4 p-3">
    <div class="s-body text-center mt-3">
        @if (Auth::user()->image != '')
            <img src="{{ Auth::user()->image }}" alt="avatar" class="rounded-circle img-fluid"
                style="width: 150px; height: 150px; object-fit: cover;">
        @else
            <img src="{{ url('assets/images/avatar7.png') }}" alt="avatar" class="rounded-circle img-fluid"
                style="width: 150px;">
        @endif

        <h5 class="mt-3 pb-0">{{ Auth::user()->name }}</h5>
        <div class="d-flex justify-content-center mb-2">

        </div>
    </div>
</div>
<div class="card account-nav border-0 shadow mb-4 mb-lg-0">
    <div class="card-body p-0">
        <ul class="list-group list-group-flush ">
            <li class="list-group-item d-flex justify-content-between p-3">
                <a href="{{ route('dashboard.users') }}">Users List</a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="{{ route('dashboard.index') }}">Jobs</a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="#">Jobs Application</a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="{{ route('logout') }}">logout</a>
            </li>
        </ul>
    </div>
</div>
