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
        <p class="text-muted mb-1 fs-6">{{ Auth::user()->designation }}</p>
        <div class="d-flex justify-content-center mb-2">
            <button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" class="btn btn-primary">Change
                Profile Picture</button>
        </div>
    </div>
</div>
<div class="card account-nav border-0 shadow mb-4 mb-lg-0">
    <div class="card-body p-0">
        <ul class="list-group list-group-flush ">
            <li class="list-group-item d-flex justify-content-between p-3">
                <a href="{{ route('profile') }}">Account Settings</a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="{{ route('create-job') }}">

                    <i class="fas fa-user-gear"></i> Post a Job</a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="{{ route('my-job') }}">
                    <i class="fas fa-briefcase"></i> My Jobs</a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="{{ route('jobApplications') }}">
                    <i class="fas fa-paper-plane"></i>Jobs Applied </a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="{{ route('saved-job-account') }}">
                    <i class="fas fa-bookmark"></i> Saved Jobs  </a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="{{ route('account.cv') }}">
                    <i class="fas fa-file-alt"></i>  Resume Builder</a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="#">
                    <i class="fas fa-lock"></i> Trainings
                </a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="#">
                    <i class="fas fa-lock"></i> Online Couching
                </a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="#">
                    <i class="fas fa-medal"></i> Archivements

                </a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="{{ route('logout') }}">
                    <i class="fas fa-sign-out-alt"></i>  logout </a>
            </li>
        </ul>
    </div>
</div>
