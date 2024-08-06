<?php

use App\Http\Controllers\AcountController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/acount/registration', [AcountController::class, 'registration'])->name('acount.registration');
Route::get('/acount/login', [AcountController::class, 'login'])->name('acount.login');
Route::post('/acount/process-register', [AcountController::class, 'processRegistration'])->name('acount.processRegistration');
