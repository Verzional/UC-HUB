<?php

use App\Http\Controllers\Main\ApplicationController;
use App\Http\Controllers\Main\CompanyController;
use App\Http\Controllers\Main\EmploymentController;
use App\Http\Controllers\Main\JobSkillController;
use App\Http\Controllers\Main\ProfileController;
use App\Http\Controllers\Main\SkillController;
use App\Http\Controllers\Main\UserController;
use App\Http\Controllers\Main\UserSkillController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile Management
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Resource Routes
Route::resource('/applications', ApplicationController::class)
    ->middleware(['auth', 'verified']);
Route::resource('/companies', CompanyController::class)
    ->middleware(['auth', 'verified']);
Route::resource('/jobs', EmploymentController::class)
    ->middleware(['auth', 'verified']);
Route::resource('/skills', SkillController::class)
    ->middleware(['auth', 'verified']);
Route::resource('/users', UserController::class)
    ->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
