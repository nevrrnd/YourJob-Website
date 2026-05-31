<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SavedJobController;
use Illuminate\Support\Facades\Route;

// ---- Public ----
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/lowongan', [HomeController::class, 'jobs'])->name('jobs.index');
Route::get('/lowongan/{job:slug}', [HomeController::class, 'show'])->name('jobs.show');

// ---- Dashboard redirect by role ----
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

// ---- Seeker ----
Route::middleware(['auth', 'role:seeker'])->prefix('seeker')->name('seeker.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'seeker'])->name('dashboard');
    Route::get('/lamaran', [ApplicationController::class, 'index'])->name('applications');
    Route::post('/lamar/{job:slug}', [ApplicationController::class, 'store'])->name('apply');
    Route::post('/simpan/{job:slug}', [SavedJobController::class, 'toggle'])->name('save');
    Route::get('/simpan', [SavedJobController::class, 'index'])->name('saved');
    Route::get('/profil', [ProfileController::class, 'seekerEdit'])->name('profile');
    Route::put('/profil', [ProfileController::class, 'seekerUpdate'])->name('profile.update');
});

// ---- Employer ----
Route::middleware(['auth', 'role:employer'])->prefix('employer')->name('employer.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'employer'])->name('dashboard');
    Route::get('/profil', [ProfileController::class, 'employerEdit'])->name('profile');
    Route::put('/profil', [ProfileController::class, 'employerUpdate'])->name('profile.update');

    Route::middleware('employer.verified')->group(function () {
        Route::resource('lowongan', JobController::class)->parameters(['lowongan' => 'job']);
        Route::get('/lowongan/{job:slug}/pelamar', [ApplicationController::class, 'applicants'])->name('applicants');
        Route::patch('/lamaran/{application}', [ApplicationController::class, 'updateStatus'])->name('application.status');
    });
});

// ---- Admin ----
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [Admin\UserController::class, 'index'])->name('users');
    Route::patch('/users/{user}/toggle', [Admin\UserController::class, 'toggle'])->name('users.toggle');
    Route::delete('/users/{user}', [Admin\UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/lowongan', [Admin\JobController::class, 'index'])->name('jobs');
    Route::delete('/lowongan/{job:slug}', [Admin\JobController::class, 'destroy'])->name('jobs.destroy');
    Route::get('/perusahaan', [Admin\CompanyController::class, 'index'])->name('companies');
    Route::patch('/perusahaan/{company}/verify', [Admin\CompanyController::class, 'verify'])->name('companies.verify');
    Route::resource('kategori', Admin\CategoryController::class)->names('categories');
    Route::get('/pengaturan', [Admin\SettingController::class, 'index'])->name('settings');
    Route::put('/pengaturan/{group}', [Admin\SettingController::class, 'update'])->name('settings.update');
});

// ---- Breeze account profile (generic) ----
Route::middleware('auth')->group(function () {
    Route::get('/account', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/account', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/account', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
