<?php

use App\Http\Controllers\JobRecommendationController;
use App\Http\Controllers\Main\ApplicationController;
use App\Http\Controllers\Main\CompanyController;
use App\Http\Controllers\Main\JobController;
use App\Http\Controllers\Main\SkillController;
use App\Http\Controllers\Main\StudentController;
use App\Http\Controllers\Main\SurveyController;
use App\Http\Controllers\Main\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentRecommendationController;
use App\Http\Controllers\Main\ICEDashboardController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', function () {
    $user = request()->user();

    if (! $user->survey) {
        return redirect()->route('surveys.create');
    }

    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin Dashboard
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified', 'role:admin'])->name('admin.dashboard');

// Profile Management
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Resource Routes
Route::resource('/applications', ApplicationController::class)
    ->middleware(['auth', 'verified', 'role:ice']);
Route::resource('/companies', CompanyController::class)
    ->middleware(['auth', 'verified', 'role:ice']);
Route::resource('/jobs', JobController::class)
    ->middleware(['auth', 'verified', 'role:ice']);
Route::resource('/skills', SkillController::class)
    ->middleware(['auth', 'verified', 'role:ice']);
Route::resource('/students', StudentController::class, ['only' => ['index', 'show']])
    ->middleware(['auth', 'verified']);
Route::resource('/surveys', SurveyController::class)
    ->middleware(['auth', 'verified']);

// Student Routes
Route::get('/students/jobs', [JobRecommendationController::class, 'index'])->name('students.jobs.index')->middleware(['auth', 'verified', 'role:student']);
Route::get('/students/jobs/{job}', [JobRecommendationController::class, 'show'])->name('students.jobs.show')->middleware(['auth', 'verified', 'role:student']);

// Admin Routes
Route::resource('/admin/users', UserController::class)
    ->middleware(['auth', 'verified', 'role:admin']);

// Recommendation Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/jobs/{job}/recommend-students', [StudentRecommendationController::class, 'recommendForJob'])->name('recommend.students');
    Route::get('/recommend-jobs', [JobRecommendationController::class, 'recommendForUser'])->name('recommend.jobs');
});

// ICE Routes Group 
Route::get('/ice/dashboard', [ICEDashboardController::class, 'index'])
    ->name('main.ice.dashboard');

// Jobs Routes
Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/my-account', [UserController::class, 'account'])->name('user.account');
    Route::put('/my-account', [UserController::class, 'updateAccount'])->name('user.update'); // Untuk simpan
    Route::get('/settings', [UserController::class, 'settings'])->name('user.settings');
    Route::put('/my-account/password', [UserController::class, 'updatePassword'])->name('user.password');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

    Route::post('/settings/update', [UserController::class, 'updateSettings'])->name('settings.update');
    Route::delete('/account/delete', [UserController::class, 'deleteAccount'])->name('account.delete');


    Route::post('/jobs/{job}/apply', [JobController::class, 'apply'])->name('jobs.apply');
});
    Route::get('/my-applications', [ApplicationController::class, 'index'])->name('applications.index');
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');
Route::post('/jobs/{job}/favorite', [JobController::class, 'toggleFavorite'])->name('jobs.favorite');
Route::get('/saved-jobs', [JobController::class, 'savedJobs'])->name('jobs.saved');
Route::delete('/jobs/{job}/favorite', [JobController::class, 'removeFavorite'])->name('jobs.unsave');


require __DIR__.'/auth.php';
