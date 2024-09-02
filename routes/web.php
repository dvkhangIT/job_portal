<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\JobApplicationController;
use App\Http\Controllers\admin\JobController as AdminJobController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/jobs', [JobController::class, 'index'])->name('jobs');
Route::get('/jobs/detail/{id}', [JobController::class, 'detail'])->name('jobDetail');
Route::post('/apply-job', [JobController::class, 'applyJob'])->name('applyJob');
Route::post('/save-job', [JobController::class, 'saveJob'])->name('saveJob');


Route::group(['prefix' => 'account'], function () {
  // Guest route
  Route::group(['middleware' => 'guest'], function () {
    Route::get('register', [AccountController::class, 'registration'])->name('account.register');
    Route::get('login', [AccountController::class, 'login'])->name('account.login');
    Route::post('process-register', [AccountController::class, 'processRegistration'])->name('account.processRegistration');
    Route::post('/account/authenticate', [AccountController::class, 'authenticate'])->name('account.authenticate');
  });
  // Authenticate route
  Route::group(['middleware' => 'auth'], function () {
    Route::get('profile', [AccountController::class, 'profile'])->name('account.profile');
    Route::get('logout', [AccountController::class, 'logout'])->name('account.logout');
    Route::put('update-profile', [AccountController::class, 'updateProfile'])->name('account.updateProfile');
    Route::post('update-profile-pic', [AccountController::class, 'updateProfilePic'])->name('account.updateProfilePic');
    Route::get('create-job', [AccountController::class, 'createJob'])->name('account.createJob');
    Route::post('save-job', [AccountController::class, 'saveJob'])->name('account.saveJob');
    Route::get('my-jobs', [AccountController::class, 'myJobs'])->name('account.myJobs');
    Route::get('my-jobs/edit/{jobId}', [AccountController::class, 'editJob'])->name('account.editJob');
    Route::post('update-job/{jobId}', [AccountController::class, 'updateJob'])->name('account.updateJob');
    Route::post('delete-job', [AccountController::class, 'deleteJob'])->name('account.deleteJob');
    Route::get('my-jobs-applications', [AccountController::class, 'myJobApplications'])->name('account.myJobApplications');
    Route::post('/remove-job-application', [AccountController::class, 'removeJobs'])->name('account.removeJobs');
    Route::get('/saved-jobs', [AccountController::class, 'savedJobs'])->name('account.savedJobs');
    Route::post('/remove-saved-job', [AccountController::class, 'removeSavedJob'])->name('account.removeSavedJob');
    Route::post('/update-password', [AccountController::class, 'updatePassword'])->name('account.updatePassword');
  });
});

Route::group(['prefix' => 'admin', 'middleware' => 'checkRole'], function () {
  Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
  Route::get('users', [UserController::class, 'index'])->name('admin.users');
  Route::get('users/{id}', [UserController::class, 'edit'])->name('admin.users.edit');
  Route::post('users/{id}', [UserController::class, 'update'])->name('admin.users.update');
  Route::delete('users', [UserController::class, 'destroy'])->name('admin.users.destroy');
  Route::get('/jobs', [AdminJobController::class, 'index'])->name('admin.jobs');
  Route::get('/jobs/edit/{id}', [AdminJobController::class, 'edit'])->name('admin.jobs.edit');
  Route::put('/jobs/{id}', [AdminJobController::class, 'update'])->name('admin.jobs.update');
  Route::delete('/jobs', [AdminJobController::class, 'destroy'])->name('admin.jobs.destroy');
  Route::get('/job-application', [JobApplicationController::class, 'index'])->name('admin.jobApplications');
  Route::delete('/job-application', [JobApplicationController::class, 'destroy'])->name('admin.jobApplications.destroy');
});
