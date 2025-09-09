<?php

use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\jobController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\GeocodeController;


use Illuminate\Http\Request;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/jobs/search', [JobController::class, 'search'])->name('jobs.search');

//Route::resource('jobs', jobController::class);
Route::resource('jobs', JobController::class)->middleware('auth')->only(['create', 'update', 'edit', 'destroy']);
Route::resource('jobs', JobController::class)->except(['create', 'update', 'edit', 'destroy']);




//Route::get('/jobs/create', [JobController::class, 'create'])->name('NewJobs'); 


// after login these pages wont need to show again
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    // GET request for login page
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    // POST request for login submission
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');


Route::middleware('auth')->group(function () {

    Route::get('/bookmarks', [BookmarkController::class, 'inedx'])->name('bookmarks.index');
    Route::post('/bookmarks/{job}', [BookmarkController::class, 'store'])->name('bookmarks.store');
    Route::delete('/bookmarks/{job}', [BookmarkController::class, 'destroy'])->name('bookmarks.destroy');
});
   Route::post('/jobs/{job}/apply', [ApplicantController::class, 'store'])->name('applicant.store')->middleware('auth');
   Route::delete('/applicant/{applicant}', [ApplicantController::class, 'destroy'])->name('applicant.destroy')->middleware('auth');

   // geocode route for map

   Route::get('/geocode',[GeocodeController::class, 'geocode']);