<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobSkillController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserSkillController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('/applications', \App\Http\Controllers\ApplicationController::class)
    ->middleware(['auth', 'verified']);
Route::resource('/companies', CompanyController::class)
    ->middleware(['auth', 'verified']);
Route::resource('/jobs', JobController::class)
    ->middleware(['auth', 'verified']);
Route::resource('/skills', SkillController::class)
    ->middleware(['auth', 'verified']);
Route::resource('/job-skills', JobSkillController::class)
    ->middleware(['auth', 'verified']);
Route::resource('/user-skills', UserSkillController::class)
    ->middleware(['auth', 'verified']);
Route::resource('/users', UserController::class)
    ->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
