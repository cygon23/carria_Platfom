@extends('front.layouts.app')


@section('main')

<div class="container">
    <h2>Add New Company and Job Positions</h2>

    <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Company Details -->
        <div class="form-group">
            <label for="name">Company Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="about">About</label>
            <textarea class="form-control" id="about" name="about" required></textarea>
        </div>

        <div class="form-group">
            <label for="offer">What We Offer</label>
            <textarea class="form-control" id="offer" name="offer" required></textarea>
        </div>

        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" class="form-control" id="location" name="location" required>
        </div>

        <!-- Image Uploads -->
        <div class="form-group">
            <label for="image">Company Image (1)</label>
            <input type="file" class="form-control" id="image" name="images[]">
        </div>

        <div id="additional-images"></div>
        <button type="button" onclick="addImageField()" class="btn btn-secondary">Add Another Image</button>

        <!-- Job Positions -->
        <h4>Job Positions</h4>

        <div id="job-positions">
            <div class="job-position">
                <div class="form-group">
                    <label>Job Title</label>
                    <input type="text" class="form-control" name="job_positions[0][title]" required>
                </div>

                <div class="form-group">
                    <label>Job Description</label>
                    <textarea class="form-control" name="job_positions[0][description]" required></textarea>
                </div>

                <div class="form-group">
                    <label>Job Image</label>
                    <input type="file" class="form-control" name="job_positions[0][image]">
                </div>
            </div>
        </div>

        <button type="button" onclick="addJobPosition()" class="btn btn-secondary mt-3">Add Another Job Position</button>
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
</div>

<script>
    let jobIndex = 1;
    let imageIndex = 1;

    function addJobPosition() {
        const jobPositions = document.getElementById('job-positions');
        const newJob = document.createElement('div');
        newJob.classList.add('job-position', 'mt-3');

        newJob.innerHTML = `
            <div class="form-group">
                <label>Job Title</label>
                <input type="text" class="form-control" name="job_positions[${jobIndex}][title]" required>
            </div>
            <div class="form-group">
                <label>Job Description</label>
                <textarea class="form-control" name="job_positions[${jobIndex}][description]" required></textarea>
            </div>
            <div class="form-group">
                <label>Job Image</label>
                <input type="file" class="form-control" name="job_positions[${jobIndex}][image]">
            </div>
        `;

        jobPositions.appendChild(newJob);
        jobIndex++;
    }

    function addImageField() {
        if (imageIndex >= 3) return;

        imageIndex++;
        const additionalImages = document.getElementById('additional-images');
        const imageField = document.createElement('div');
        imageField.classList.add('form-group', 'mt-2');

        imageField.innerHTML = `
            <label for="image${imageIndex}">Company Image (${imageIndex})</label>
            <input type="file" class="form-control" id="image${imageIndex}" name="images[]">
        `;

        additionalImages.appendChild(imageField);
    }
</script>
@endsection




