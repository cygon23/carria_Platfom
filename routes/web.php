<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\homeController;
use Illuminate\Support\Facades\Route;


Route::get('/', [homeController::class, 'index']);

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
    Route::post('/save-job', [AuthController::class, 'saveJob'])->name('save-job');
    Route::get('/my-jobs', [AuthController::class, 'myJobs'])->name('my-job');
    Route::get('/edit-jobs/{id}', [AuthController::class, 'editJob'])->name('edit-job');
    Route::post('/update-job/{id}', [AuthController::class, 'updateJob'])->name('update-job');
    Route::post('/delete-job/{id}', [AuthController::class, 'deleteJob'])->name('delete-job');
    // Route for restoring a deleted job*future
    //Route::post('/restore-job/{id}', [AuthController::class, 'restoreJob'])->name('restore-job');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
