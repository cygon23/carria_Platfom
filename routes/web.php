<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\JobAdminController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

//public url
Route::get('/', [homeController::class, 'index']);
Route::get('/account/jobs', [JobController::class, 'index'])->name('/account/jobs');
Route::get('/account/jobs/detail/{id}', [JobController::class, 'jobDetail'])->name('/account/jobs/detail');
Route::post('/apply-job', [JobController::class, 'applyJob'])->name('apply-job');


Route::middleware('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/users', [UserController::class, 'users'])->name('dashboard.users');
    Route::get('/dashboard/edit/{id}', [UserController::class, 'editUser'])->name('dashboard.edit');
    Route::post('/dashboard/update/{id}', [UserController::class, 'updateUser'])->name('dashboard.update');
    Route::post('/dashboard/delete/{id}', [UserController::class, 'deleteUser'])->name('dashboard.delete');
    Route::get('/dashboard/jobs', [JobAdminController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/edit/admin/{id}', [JobAdminController::class, 'editJob'])->name('dashboard.Jobedit');
    Route::post('/dashboard/update/admin/{id}', [JobAdminController::class, 'adminUpdateJob'])->name('dashboard.updateJob');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/register', [AuthController::class, 'processRegistration']);
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login/authenticate', [AuthController::class, 'authenticate'])->name('login.authenticate');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('/updateProfile', [AuthController::class, 'updateProfile'])->name('updateProfile');
    Route::post('/profileImage', [AuthController::class, 'profileImage'])->name('profileImage');
    Route::get('/create-job', [AuthController::class, 'createJob'])->name('create-job');
    Route::post('/addjobs', [TestController::class, 'addJobs'])->name('add-jobs');
    Route::get('/my-jobs', [AuthController::class, 'myJobs'])->name('my-job');
    Route::get('/edit-jobs/{id}', [AuthController::class, 'editJob'])->name('edit-job');
    Route::post('/update-job/{id}', [AuthController::class, 'updateJob'])->name('update-job');
    Route::post('/delete-job/{id}', [AuthController::class, 'deleteJob'])->name('delete-job');
    // Route for restoring a deleted job*future
    //Route::post('/restore-job/{id}', [AuthController::class, 'restoreJob'])->name('restore-job');
    Route::get('/jobApplications', [AuthController::class, 'myJobApplication'])->name('jobApplications');
    Route::post('/jobApplications/{jobId}', [AuthController::class, 'removeJob'])->name('delete-Appliedjob');
    Route::post('/delete-Savedjob/{jobId}', [AuthController::class, 'removeSavedJob'])->name('delete-Savedjob');
    Route::post('/save-job', [JobController::class, 'saveJob'])->name('save-job');
    Route::get('/saved-job-account', [AuthController::class, 'savedJobAccount'])->name('saved-job-account');
    Route::post('/password-update', [AuthController::class, 'updatePassword'])->name('password-update');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
