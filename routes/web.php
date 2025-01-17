<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\JobAdminController;
use App\Http\Controllers\admin\JobApplicationController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CVController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\TestController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


//public url
Route::get('/', [homeController::class, 'index']);
Route::get('/companies', [homeController::class, 'featuredCompanies'])->name('companies');
Route::get('/explore', [homeController::class, 'exploreSection'])->name('explore');

Route::get('/account/jobs', [JobController::class, 'index'])->name('/account/jobs');
Route::get('/account/jobs/detail/{id}', [JobController::class, 'jobDetail'])->name('/account/jobs/detail');
Route::post('/apply-job', [JobController::class, 'applyJob'])->name('apply-job');
Route::get('/password-forgot', [AuthController::class, 'forgotPassword'])->name('password-forgot');
Route::post('/password-forgot', [AuthController::class, 'processForgotPassword'])->name('password-forgot.email');
Route::get('/password-forgot/{token}', [AuthController::class, 'emailResetPassword'])->name('password-reset.email');
Route::post('/password-forgot/email-request', [AuthController::class, 'processEmailResetPassword'])->name('password-reset.email.reqest');

  Route::get('/companies',[CompanyController::class,'index'])->name('companies');

Route::middleware('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/dashboard/users', [UserController::class, 'users'])->name('dashboard.users');
    Route::get('/dashboard/edit/{id}', [UserController::class, 'editUser'])->name('dashboard.edit');
    Route::post('/dashboard/update/{id}', [UserController::class, 'updateUser'])->name('dashboard.update');
    Route::post('/dashboard/delete/{id}', [UserController::class, 'deleteUser'])->name('dashboard.delete');

    Route::get('/dashboard/jobs', [JobAdminController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/edit/admin/{id}', [JobAdminController::class, 'editJob'])->name('dashboard.Jobedit');
    Route::post('/dashboard/update/admin/{id}', [JobAdminController::class, 'adminUpdateJob'])->name('dashboard.updateJob');
    Route::post('/dashboard/admin/delete/{id}', [JobAdminController::class, 'admindeleteJob'])->name('dashboard.deleteJob');

    Route::get('/dashboard/jobs/application', [JobApplicationController::class, 'index'])->name('dashboard.application.index');
    Route::post('/dashboard/admin/application/delete/{id}', [JobApplicationController::class, 'admindeleteJobApplication'])->name('dashboard.deleteJob.application');

    //on work
    Route::get('/companies/create', [CompanyController::class, 'create'])->name('companies.create');
    Route::post('/companies', [CompanyController::class, 'store'])->name('companies.store');

    //cv viewing
     Route::get('/admin/submitted-cvs', [DashboardController::class, 'showSubmittedCVs'])->name('admin.submittedCvs');
     Route::delete('/cv/delete', [CVController::class, 'delete'])->name('cv.delete');

});

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/register', [AuthController::class, 'processRegistration']);
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login/authenticate', [AuthController::class, 'authenticate'])->name('login.authenticate')->middleware('throttle:5,1');;
    Route::get('verify/{token}', [AuthController::class, 'verify']);

    //email verification
    Route::get('/email/verify', [AuthController::class, 'verifyemail'])->name('verification.notice');
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
    //cv url
    Route::get('accounts/cv', [CVController::class, 'index'])->name('account.cv');
    Route::post('/upload-cv', [CVController::class, 'upload'])->name('cv.upload');
    Route::get('/download-cv', [CVController::class, 'download'])->name('cv.download');
    Route::get('/download-cv', function () {
    $user = Auth::user();
    if (!$user || !$user->cv_url) {
        return redirect()->back()->with('error', 'No CV found for this user.');
    }
    $filePath = public_path($user->cv_url);

    if (!file_exists($filePath)) {
        return redirect()->back()->with('error', 'CV file not found.');
    }
    return response()->download($filePath);
    })->name('cv.download')->middleware('auth');

    ///cv url user created for them self
    Route::get('cv/basic', [CVController::class, 'basic'])->name('cv.basic');
    Route::post('cv/basic/store', [CVController::class, 'storeBasic'])->name('cv.basic.store');
    Route::get('cv/education', [CVController::class, 'education'])->name('cv.education');
    Route::post('cv/education/store', [CVController::class, 'storeEducation'])->name('cv.education.store');
    Route::get('cv/experience', [CVController::class, 'experience'])->name('cv.experience');
    Route::post('cv/experience/store', [CVController::class, 'storeExperience'])->name('cv.experience.store');
    Route::get('cv/skills', [CVController::class, 'skills'])->name('cv.skills');
    Route::post('cv/skills/store', [CVController::class, 'storeSkills'])->name('cv.skills.store');
    Route::get('cv/awards', [CVController::class, 'awards'])->name('cv.awards');
    Route::post('cv/awards/store', [CVController::class, 'storeAwards'])->name('cv.awards.store');
    // Route::get('/cv/preview/{id}', [CvController::class, 'preview'])->name('cv.preview');
    Route::get('/cv/preview/{id}', [CvController::class, 'preview'])->name('cv.preview');


    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});


Route::get('/auth/google/redirect', function (Request $request) {
    return Socialite::driver("google")->redirect();
});


Route::get('/auth/google/callback', function (Request $request) {
    $googleUser = Socialite::driver("google")->user();

    $user = User::updateOrCreate(
        ['google_id' => $googleUser->id],
        [
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'password' => Hash::make(Str::random(12)),
            'email_verified_at' => now()
        ]
    );

    Auth::login($user);
    return redirect('/profile');
});


 Route::get('auth/linkedin-openid/redirect', function (Request $request){
    return Socialite::driver("linkedin-openid")->redirect();
 });


 Route::get('/auth/linkedin-openid/callback', function (Request $request){
     $linkedinUser = Socialite::driver("linkedin-openid")->user();

   $user = User::updateOrCreate(
        ['linkedin_id' => $linkedinUser->id],
        [
            'name' => $linkedinUser->name,
            'email' => $linkedinUser->email,
            'password' => Hash::make(Str::random(12)),
            // 'email_verified_at' => now()
        ]
    );

          Auth::login($user);
          return redirect('/profile');
    });







