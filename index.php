<?php

session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: sign-in.php"); // Redirect to login if not logged in
    exit();
}

// Display the user's email
$user_email = $_SESSION['email'];
?>
<?php include './partials/layouts/layoutTop.php' ?>
<h1 class="h4 text-muted fw-normal">
    Welcome, <?php echo htmlspecialchars($user_email); ?>!
</h1>

    <div class="row row-cols-xxxl-5 row-cols-lg-3 row-cols-sm-2 row-cols-1 gy-4">
        <div class="col">
            <div class="card shadow-none border bg-gradient-start-1 h-100">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <p class="fw-medium text-primary-light mb-1">Possible Opportunities</p>
                            <h6 class="mb-0">20+</h6>
                        </div>
                        <div class="w-50-px h-50-px bg-cyan rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="gridicons:multiple-users" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>
                    <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                        <span class="d-inline-flex align-items-center gap-1 text-success-main">
                        </span>
                        
                    </p>
                </div>
            </div><!-- card end -->
        </div>
        <div class="col">
            <div class="card shadow-none border bg-gradient-start-2 h-100">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <p class="fw-medium text-primary-light mb-1">Total Applications</p>
                            <h6 class="mb-0">15</h6>
                        </div>
                        <div class="w-50-px h-50-px bg-purple rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fa-solid:award" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>
                    <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                        <span class="d-inline-flex align-items-center gap-1 text-danger-main">
                            <iconify-icon icon="bxs:down-arrow" class="text-xs"></iconify-icon>
                        </span>
                        
                    </p>
                </div>
            </div><!-- card end -->
        </div>
        <div class="col">
            <div class="card shadow-none border bg-gradient-start-3 h-100">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <p class="fw-medium text-primary-light mb-1">Total Trainings</p>
                            <h6 class="mb-0">5</h6>
                        </div>
                        <div class="w-50-px h-50-px bg-info rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fluent:people-20-filled" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>
                    <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                        <span class="d-inline-flex align-items-center gap-1 text-success-main">
                           
                        </span>
                        
                    </p>
                </div>
            </div><!-- card end -->
        </div>
        <div class="col">
            <div class="card shadow-none border bg-gradient-start-4 h-100">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <p class="fw-medium text-primary-light mb-1">Total Coaches</p>
                            <h6 class="mb-0">2</h6>
                        </div>
                        <div class="w-50-px h-50-px bg-success-main rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="solar:wallet-bold" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>
                    <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                        <span class="d-inline-flex align-items-center gap-1 text-success-main">
                            </span>
                       
                    </p>
                </div>
            </div><!-- card end -->
        </div>
        <div class="col">
            <div class="card shadow-none border bg-gradient-start-5 h-100">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <p class="fw-medium text-primary-light mb-1">Total Skills</p>
                            <h6 class="mb-0">6</h6>
                        </div>
                        <div class="w-50-px h-50-px bg-red rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fa6-solid:file-invoice-dollar" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>
                    <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                        <span class="d-inline-flex align-items-center gap-1 text-success-main">
                        </span>
                        
                    </p>
                </div>
            </div><!-- card end -->
        </div>
    </div>

    <div class="row gy-4 mt-1">
        <div class="col-xxl-6 col-xl-12">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center justify-content-between">
                        <h6 class="text-lg mb-0">Competition Statistic</h6>
                        <select class="form-select bg-base form-select-sm w-auto">
                            <option>Yearly</option>
                            <option>Monthly</option>
                            <option>Weekly</option>
                            <option>Today</option>
                        </select>
                    </div>
                    <div class="d-flex flex-wrap align-items-center gap-2 mt-8">
                        <h6 class="mb-0">$27</h6>
                        <span class="text-sm fw-semibold rounded-pill bg-success-focus text-success-main border br-success px-8 py-4 line-height-1 d-flex align-items-center gap-1">
                            10% <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon>
                        </span>
                        <span class="text-xs fw-medium">+ $5 Per Day</span>
                    </div>
                    <div id="chart" class="pt-28 apexcharts-tooltip-style-1"></div>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-xl-6">
            <div class="card h-100 radius-8 border">
                <div class="card-body p-24">
                    <h6 class="mb-12 fw-semibold text-lg mb-16">Total Subscriber</h6>
                    <div class="d-flex align-items-center gap-2 mb-20">
                        <h6 class="fw-semibold mb-0">10</h6>
                        <p class="text-sm mb-0">
                            <span class="bg-danger-focus border br-danger px-8 py-2 rounded-pill fw-semibold text-danger-main text-sm d-inline-flex align-items-center gap-1">
                                10%
                                <iconify-icon icon="iconamoon:arrow-down-2-fill" class="icon"></iconify-icon>
                            </span>
                            - 20 Per Day
                        </p>
                    </div>

                    <div id="barChart"></div>

                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-xl-6">
            <div class="card h-100 radius-8 border-0 overflow-hidden">
                <div class="card-body p-24">
                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                        <h6 class="mb-2 fw-bold text-lg">Users Overview</h6>
                        <div class="">
                            <select class="form-select form-select-sm w-auto bg-base border text-secondary-light">
                                <option>Today</option>
                                <option>Weekly</option>
                                <option>Monthly</option>
                                <option>Yearly</option>
                            </select>
                        </div>
                    </div>


                    <div id="userOverviewDonutChart"></div>

                    <ul class="d-flex flex-wrap align-items-center justify-content-between mt-3 gap-3">
                        <li class="d-flex align-items-center gap-2">
                            <span class="w-12-px h-12-px radius-2 bg-primary-600"></span>
                            <span class="text-secondary-light text-sm fw-normal">New:
                                <span class="text-primary-light fw-semibold">500</span>
                            </span>
                        </li>
                        <li class="d-flex align-items-center gap-2">
                            <span class="w-12-px h-12-px radius-2 bg-yellow"></span>
                            <span class="text-secondary-light text-sm fw-normal">Subscribed:
                                <span class="text-primary-light fw-semibold">10</span>
                            </span>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
        <div class="col-xxl-9 col-xl-12">
            <div class="card h-100">
                <div class="card-body p-24">

                    <div class="d-flex flex-wrap align-items-center gap-1 justify-content-between mb-16">
                        <ul class="nav border-gradient-tab nav-pills mb-0" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link d-flex align-items-center active" id="pills-to-do-list-tab" data-bs-toggle="pill" data-bs-target="#pills-to-do-list" type="button" role="tab" aria-controls="pills-to-do-list" aria-selected="true">
                                    Recently Apllied Opportunities
                                    <span class="text-sm fw-semibold py-6 px-12 bg-neutral-500 rounded-pill text-white line-height-1 ms-12 notification-alert">35</span>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link d-flex align-items-center" id="pills-recent-leads-tab" data-bs-toggle="pill" data-bs-target="#pills-recent-leads" type="button" role="tab" aria-controls="pills-recent-leads" aria-selected="false" tabindex="-1">
                                    My Training 
                                    <span class="text-sm fw-semibold py-6 px-12 bg-neutral-500 rounded-pill text-white line-height-1 ms-12 notification-alert">35</span>
                                </button>
                            </li>
                        </ul>
                        <a href="javascript:void(0)" class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                            View All
                            <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                        </a>
                    </div>

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-to-do-list" role="tabpanel" aria-labelledby="pills-to-do-list-tab" tabindex="0">
                            <div class="table-responsive scroll-sm">
                                <table class="table bordered-table sm-table mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Users </th>
                                            <th scope="col">Registered On</th>
                                            <th scope="col">Plan</th>
                                            <th scope="col" class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="assets/images/users/user1.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                                    <div class="flex-grow-1">
                                                        <h6 class="text-md mb-0 fw-medium">Dianne Russell</h6>
                                                        <span class="text-sm text-secondary-light fw-medium">redaniel@gmail.com</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>27 Mar 2024</td>
                                            <td>Free</td>
                                            <td class="text-center">
                                                <span class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Active</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-recent-leads" role="tabpanel" aria-labelledby="pills-recent-leads-tab" tabindex="0">
                            <div class="table-responsive scroll-sm">
                                <table class="table bordered-table sm-table mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Users </th>
                                            <th scope="col">Registered On</th>
                                            <th scope="col">Plan</th>
                                            <th scope="col" class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="assets/images/users/user1.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                                    <div class="flex-grow-1">
                                                        <h6 class="text-md mb-0 fw-medium">Dianne Russell</h6>
                                                        <span class="text-sm text-secondary-light fw-medium">redaniel@gmail.com</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>27 Mar 2024</td>
                                            <td>Free</td>
                                            <td class="text-center">
                                                <span class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Active</span>
                                            </td>
                                        </tr> 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-xl-12">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                        <h6 class="mb-2 fw-bold text-lg mb-0">Notifications</h6>
                        <a href="javascript:void(0)" class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                            View All
                            <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                        </a>
                    </div>

                    <div class="mt-32">

                        <div class="d-flex align-items-center justify-content-between gap-3 mb-24">
                            <div class="d-flex align-items-center">
                                <img src="assets/images/users/user1.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                <div class="flex-grow-1">
                                    <h6 class="text-md mb-0 fw-medium">Dianne Russell</h6>
                                    <span class="text-sm text-secondary-light fw-medium">Agent ID: 36254</span>
                                </div>
                            </div>
                            <span class="text-primary-light text-md fw-medium">$20</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
       
            </div>
        </div>
    </div>

<?php $script = '<script src="assets/js/homeOneChart.js"></script>';?>
<?php include './partials/layouts/layoutBottom.php' ?>