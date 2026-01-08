<?php

use App\Http\Controllers\Main\ApplicationController;
use App\Http\Controllers\Main\CompanyController;
use App\Http\Controllers\Main\JobController;
use App\Http\Controllers\Main\SkillController;
use App\Http\Controllers\Main\UserController;
use App\Http\Controllers\Main\SurveyController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', function () {
    $user = request()->user();

    if ($user->role === 'Admin') {
        return redirect()->route('admin.dashboard');
    }

    if ($user->role === 'ICE') {
        return redirect()->route('ice.dashboard');
    }

    if ($user->role === 'Student' && !$user->survey) {
        return redirect()->route('surveys.create');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin Dashboard
Route::get('/ice/dashboard', function () {
    return view('ice.dashboard');
})->middleware(['auth', 'verified', 'role:ICE'])->name('ice.dashboard');

// ICE Dashboard
Route::get('/ice/dashboard', function () {
    return view('ice.dashboard');
})->middleware(['auth', 'verified', 'role:ICE'])->name('ice.dashboard');

// Profile Management
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/survey', [SurveyController::class, 'create'])->name('surveys.create');
    Route::post('/survey', [SurveyController::class, 'store'])->name('surveys.store');
    Route::patch('/profile/extra', [ProfileController::class, 'updateExtra'])
    ->name('profile.update.extra');

});


// Resource Routes
Route::resource('/applications', ApplicationController::class)
    ->middleware(['auth', 'verified', 'role:ICE']);
Route::resource('/companies', CompanyController::class)
    ->middleware(['auth', 'verified', 'role:ICE']);
Route::resource('/jobs', JobController::class)
    ->middleware(['auth', 'verified', 'role:ICE']);
Route::resource('/skills', SkillController::class)
    ->middleware(['auth', 'verified', 'role:ICE']);
Route::resource('/users', UserController::class)
    ->middleware(['auth', 'verified', 'role:ICE']);
Route::resource('/surveys', SurveyController::class)
    ->middleware(['auth', 'verified']);

require __DIR__ . '/auth.php';
