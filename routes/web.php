<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DebugLogController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/projects', [HomeController::class, 'projects'])->name('projects.index');

// Authentication routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/check-qr', [AuthController::class, 'checkQr'])->name('check.qr');
Route::post('/login-qr', [AuthController::class, 'loginQr'])->name('login.qr');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Debug logs (public for development - restrict in production)
Route::get('/debuglog', [DebugLogController::class, 'index'])->name('debug.logs');
Route::delete('/debuglog/clear', [DebugLogController::class, 'clear'])->name('debug.logs.clear');
Route::post('/debuglog/download', [DebugLogController::class, 'download'])->name('debug.logs.download');
Route::get('/debuglog/test', [DebugLogController::class, 'testLog'])->name('debug.logs.test');

// Protected routes (require authentication)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/dashboard/projects', [ProjectController::class, 'index'])->name('dashboard.projects.index');
    Route::get('/dashboard/projects/create', [ProjectController::class, 'create'])->name('dashboard.projects.create');
    Route::post('/dashboard/projects', [ProjectController::class, 'store'])->name('dashboard.projects.store');
    Route::get('/dashboard/projects/{id}/edit', [ProjectController::class, 'edit'])->name('dashboard.projects.edit');
    Route::put('/dashboard/projects/{id}', [ProjectController::class, 'update'])->name('dashboard.projects.update');
    Route::delete('/dashboard/projects/{id}', [ProjectController::class, 'destroy'])->name('dashboard.projects.destroy');
});