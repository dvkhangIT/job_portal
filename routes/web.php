<?php

use App\Http\Controllers\AcountController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::group(['prefix' => 'acount'], function () {
  // Route guest
  Route::group(['middleware' => 'guest'], function () {
    Route::get('registration', [AcountController::class, 'registration'])->name('acount.registration');
    Route::get('login', [AcountController::class, 'login'])->name('acount.login');
    Route::post('process-register', [AcountController::class, 'processRegistration'])->name('acount.processRegistration');
    Route::post('/acount/authenticate', [AcountController::class, 'authenticate'])->name('acount.authenticate');
  });
  // Route authentication
  Route::group(['middleware' => 'auth'], function () {
    Route::get('profile', [AcountController::class, 'profile'])->name('acount.profile');
    Route::get('logout', [AcountController::class, 'logout'])->name('acount.logout');
  });
});
