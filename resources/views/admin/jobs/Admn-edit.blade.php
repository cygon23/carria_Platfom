@extends('front.layouts.app')

@section('main')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Edit Job</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    @include('admin.sidebar-adm')
                </div>
                <div class="col-lg-9">
                    <div class="card border-0 shadow mb-4 ">
                        <div class="card-body card-form p-4">
                            <h3 class="fs-4 mb-1">Edit Job Details</h3>
                            @include('front.layouts._message')
                            <form method="POST" action="{{ route('dashboard.updateJob', $job->id) }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="title" class="mb-2">Title<span class="req">*</span></label>
                                        <input type="text" value="{{ $job->title }}" placeholder="Job Title"
                                            id="title" name="title" class="form-control">
                                        @error('title')
                                            <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}
                                            </p>
                                            <!-- Use $message for error messages -->
                                        @enderror
                                    </div>
                                    <div class="col-md-6  mb-4">
                                        <label for="category" class="mb-2">Category<span class="req">*</span></label>
                                        <select name="category" id="category" class="form-control">
                                            <option value="">Select a Category</option>
                                            @if ($categories->isNotEmpty())
                                                @foreach ($categories as $category)
                                                    <option {{ $job->category_id == $category->id ? 'selected' : '' }}
                                                        value="{{ $category->id }}">{{ $category->name }}
                                                    </option>
                                                @endforeach
                                            @endif

                                        </select>
                                        @error('category')
                                            <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}
                                            </p>
                                            <!-- Use $message for error messages -->
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="job_nature" class="mb-2">Job Nature<span
                                                class="req">*</span></label>
                                        <select class="form-select" name="job_nature" id="job_nature">
                                            <option value="">Select Job Nature</option>
                                            @if ($jobTypes->isNotEmpty())
                                                @foreach ($jobTypes as $jobType)
                                                    <option value="{{ $jobType->id }}"
                                                        {{ $job->job_type_id == $jobType->id ? 'selected' : '' }}>
                                                        {{ $jobType->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('job_nature')
                                            <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}
                                            </p>
                                            <!-- Use $message for error messages -->
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="vacancy" class="mb-2">Vacancy<span class="req">*</span></label>
                                        <input type="number" value="{{ $job->vacancy }}" min="1"
                                            placeholder="Vacancy" id="vacancy" name="vacancy" class="form-control">
                                        @error('vacancy')
                                            <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}
                                            </p>
                                            <!-- Use $message for error messages -->
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-4 col-md-6">
                                        <label for="salary" class="mb-2">Salary</label>
                                        <input type="text" value="{{ $job->salary }}" placeholder="Salary"
                                            id="salary" name="salary" class="form-control">

                                    </div>

                                    <div class="mb-4 col-md-6">
                                        <label for="location" class="mb-2">Location<span class="req">*</span></label>
                                        <input type="text" value="{{ $job->location }}" placeholder="location"
                                            id="location" name="location" class="form-control">
                                        @error('location')
                                            <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}
                                            </p>
                                            <!-- Use $message for error messages -->
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="description" class="mb-2">Description<span class="req">*</span></label>
                                    <textarea class="textarea" name="description" id="description" cols="5" rows="5" placeholder="Description">{{ $job->description }}</textarea>
                                    @error('description')
                                        <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                                        <!-- Use $message for error messages -->
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="benefits" class="mb-2">Benefits</label>
                                    <textarea class="textarea" name="benefits" id="benefits" cols="5" rows="5" placeholder="Benefits">{{ $job->benefits }}</textarea>
                                </div>

                                <div class="mb-4">
                                    <label for="responsibility" class="mb-2">Responsibility</label>
                                    <textarea class="textarea" name="responsibility" id="responsibility" cols="5" rows="5"
                                        placeholder="Responsibility">{{ $job->responsibility }}</textarea>
                                </div>

                                <div class="mb-4">
                                    <label for="qualifications" class="mb-2">Qualifications</label>
                                    <textarea class="textarea" name="qualification" id="qualifications" cols="5" rows="5"
                                        placeholder="Qualifications">{{ $job->qualification }}</textarea>
                                </div>

                                <div class="mb-4">
                                    <label for="experience" class="mb-2">Experience <span
                                            class="req">*</span></label>
                                    <select name="experience" id="experience" class="form-control">
                                        <option value="1"{{ $job->experience == 1 ? 'selected' : '' }}>1
                                            year
                                        </option>
                                        <option value="2"{{ $job->experience == 2 ? 'selected' : '' }}>2
                                            years
                                        </option>
                                        <option value="3"{{ $job->experience == 3 ? 'selected' : '' }}>3
                                            years
                                        </option>
                                        <option value="4"{{ $job->experience == 4 ? 'selected' : '' }}>4
                                            years
                                        </option>
                                        <option value="5"{{ $job->experience == 5 ? 'selected' : '' }}>5
                                            years
                                        </option>
                                        <option value="6"{{ $job->experience == 6 ? 'selected' : '' }}>6
                                            years
                                        </option>
                                        <option value="7"{{ $job->experience == 7 ? 'selected' : '' }}>7
                                            years
                                        </option>
                                        <option value="8"{{ $job->experience == 8 ? 'selected' : '' }}>8
                                            years
                                        </option>
                                        <option value="9"{{ $job->experience == 9 ? 'selected' : '' }}>9
                                            years
                                        </option>
                                        <option value="10"{{ $job->experience == 10 ? 'selected' : '' }}>
                                            10 years
                                        </option>
                                        <option value="10_plus"{{ $job->experience == '10_plus' ? 'selected' : '' }}>
                                            10+
                                            years</option>
                                    </select>
                                    @error('experience')
                                        <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                                        <!-- Use $message for error messages -->
                                    @enderror
                                </div>


                                <div class="mb-4">
                                    <label for="keywords" class="mb-2">Keywords<span class="req">*</span></label>
                                    <input type="text" placeholder="keywords" id="keywords" name="keywords"
                                        class="form-control" value="{{ $job->keywords }}">
                                    @error('keywords')
                                        <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                                        <!-- Use $message for error messages -->
                                    @enderror
                                </div>

                                <h3 class="fs-4 mb-1 mt-5 border-top pt-5">Company Details</h3>

                                <div class="row">
                                    <div class="mb-4 col-md-6">
                                        <label for="company_name" class="mb-2">Name<span
                                                class="req">*</span></label>
                                        <input type="text" placeholder="Company Name" id="company_name"
                                            name="company_name" class="form-control" value="{{ $job->company_name }}">
                                        @error('company_name')
                                            <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}
                                            </p>
                                            <!-- Use $message for error messages -->
                                        @enderror
                                    </div>

                                    <div class="mb-4 col-md-6">
                                        <label for="location" class="mb-2">Location</label>
                                        <input type="text" placeholder="Location" id="company_location"
                                            name="company_location" class="form-control"
                                            value="{{ $job->company_location }}">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="website" class="mb-2">Website</label>
                                    <input type="text" placeholder="company_website" id="website" name="website"
                                        class="form-control" value="{{ $job->company_website }}">
                                </div>

                                <div class="card-footer p-4">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
