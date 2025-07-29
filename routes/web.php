<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\jobController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', [HomeController::class, 'index']);

Route::resource('jobs', jobController::class);
//Route::get('/jobs/create', [JobController::class, 'create'])->name('NewJobs');