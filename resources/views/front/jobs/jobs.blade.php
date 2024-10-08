@extends('front.layouts.app')


@section('main')
    <section class="section-3 py-5 bg-2 ">
        <div class="container">
            <div class="row">
                <div class="col-6 col-md-10 ">
                    <h2>Find Jobs</h2>
                </div>
                <div class="col-6 col-md-2">
                    <div class="align-end">
                        <select name="sort" id="sort" class="form-control">
                            <option value="1" {{ Request::get('sort') == '1' ? 'selected' : '' }}>Latest</option>
                            <option value="0"{{ Request::get('sort') == '0' ? 'selected' : '' }}>Oldest</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row pt-5">
                <div class="col-md-4 col-lg-3 sidebar mb-4">
                    <form action="" name="searchForm" id="searchForm">
                        <div class="card border-0 shadow p-4">
                            <div class="mb-4">
                                <h2>Keywords</h2>
                                <input type="text" id="keywords" name="keywords" placeholder="Keywords"
                                    class="form-control">
                            </div>

                            <div class="mb-4">
                                <h2>Location</h2>
                                <input type="text" name="location" id="location" placeholder="Location"
                                    class="form-control">
                            </div>

                            <div class="mb-4">
                                <h2>Category</h2>
                                <select name="category" id="category" class="form-control">
                                    <option value="">Select a Category</option>
                                    @if ($categories)
                                        @foreach ($categories as $category)
                                            <option {{ Request::get('category') == $category->id ? 'selected' : '' }}
                                                value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    @endif

                                </select>
                            </div>

                            <div class="mb-4">
                                <h2>Job Type</h2>
                                @if ($jobTypes)
                                    @foreach ($jobTypes as $jobType)
                                        <div class="form-check mb-2">
                                            <input {{ in_array($jobType->id, $jobsTypeArray) ? 'checked' : '' }}
                                                class="form-check-input " name="job_type" type="checkbox"
                                                value="{{ $jobType->id }}" id="jobType_{{ $jobType->id }}">

                                            <label class="form-check-label "
                                                for="jobType_{{ $jobType->id }}">{{ $jobType->name }}</label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <div class="mb-4">
                                <h2>Experience</h2>
                                <select name="experience" id="experience" class="form-control">
                                    <option value="">Select Experience</option>
                                    <option value="1"{{ Request::get('experience') == 1 ? 'selected' : '' }}>1 Year
                                    </option>
                                    <option value="2"{{ Request::get('experience') == 2 ? 'selected' : '' }}>2 Years
                                    </option>
                                    <option value="3"{{ Request::get('experience') == 3 ? 'selected' : '' }}>3 Years
                                    </option>
                                    <option value="4"{{ Request::get('experience') == 4 ? 'selected' : '' }}>4 Years
                                    </option>
                                    <option value="5"{{ Request::get('experience') == 5 ? 'selected' : '' }}>5 Years
                                    </option>
                                    <option value="6"{{ Request::get('experience') == 6 ? 'selected' : '' }}>6 Years
                                    </option>
                                    <option value="7"{{ Request::get('experience') == 7 ? 'selected' : '' }}>7 Years
                                    </option>
                                    <option value="8"{{ Request::get('experience') == 8 ? 'selected' : '' }}>8 Years
                                    </option>
                                    <option value="9"{{ Request::get('experience') == 9 ? 'selected' : '' }}>9 Years
                                    </option>
                                    <option value="10"{{ Request::get('experience') == 10 ? 'selected' : '' }}>10 Years
                                    </option>
                                    <option value="10_plus"{{ Request::get('experience') == '10_plus' ? 'selected' : '' }}>
                                        10+ Years</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Search</button>
                            <a href="{{ route('/account/jobs') }}" class="btn btn-secondary mt-3">Reset</a>
                        </div>
                    </form>
                </div>
                <div class="col-md-8 col-lg-9 ">
                    <div class="job_listing_area">
                        <div class="job_lists">
                            <div class="row">
                                @if ($jobs->isNotEmpty())
                                    @foreach ($jobs as $job)
                                        <div class="col-md-4">
                                            <div class="card border-0 p-3 shadow mb-4">
                                                <div class="card-body">
                                                    <h3 class="border-0 fs-5 pb-2 mb-0">{{ $job->title }}</h3>
                                                    <p>{{ Str::words($job->description, 10, '...') }}</p>
                                                    <div class="bg-light p-3 border">
                                                        <p class="mb-0">
                                                            <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                            <span class="ps-1">{{ $job->location }}</span>
                                                        </p>
                                                        <p class="mb-0">
                                                            <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                            <span class="ps-1">{{ $job->JobType->name }}</span>
                                                        </p>
                                                        {{-- <p>Keywords:{{ $job->keywords }}</p>
                                                        <p>Category:{{ $job->category->name }}</p>
                                                        <p>Experience:{{ $job->experience }}</p> --}}
                                                        @if (!is_null($job->salary))
                                                            <p class="mb-0">
                                                                <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                                <span class="ps-1">{{ $job->salary }}</span>
                                                            </p>
                                                        @endif
                                                    </div>
                                                    <div class="d-grid mt-3">
                                                        <a href="{{ route('/account/jobs/detail', $job->id) }}"
                                                            class="btn btn-primary btn-lg">Details</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-md-12">Jobs Not found</div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('customJs')

@section('customJs')
    <script>
        $("#searchForm").submit(function(e) {
            e.preventDefault();


            var url = "{{ route('/account/jobs') }}";
            var keyword = $("#keywords").val();
            var location = $("#location").val();
            var category = $("#category").val();
            var experience = $("#experience").val();
            var sort = $("#sort").val();

            //check box when selected
            var checkedJobTypes = $("input:checkbox[name='job_type']:checked").map(function() {
                return $(this).val();
            }).get();

            // If the keyword has a value
            if (keyword != "") {

                url += '?keyword=' + encodeURIComponent(keyword);
            }

            // If the location has a value
            if (location != "") {

                url += '?location=' + encodeURIComponent(location);
            }

            // If the Category has a value
            if (category != "") {

                url += '?category=' + encodeURIComponent(category);
            }


            // If the Experience has a value
            if (experience != "") {

                url += '?experience=' + encodeURIComponent(experience);
            }

            // if user has checked job types
            if (checkedJobTypes.length > 0) {
                url += '?jobType=' + encodeURIComponent(checkedJobTypes);
            }

            //sorting basing on the oldest and newest

            url += '&sort=' + sort;

            window.location.href = url;
        });

        $("#sort").change(function() {
            $("#searchForm").submit();
        });
    </script>
@endsection
