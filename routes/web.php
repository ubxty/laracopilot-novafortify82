<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\OpensourceProjectController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DebugLogController;
use App\Http\Controllers\ArtisanController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Public project listing
Route::get('/projects/public', [ProjectController::class, 'publicIndex'])->name('projects.public');

// Protected routes - Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/projects', [ProjectController::class, 'index'])->name('dashboard.projects.index');
Route::get('/dashboard/projects/create', [ProjectController::class, 'create'])->name('dashboard.projects.create');
Route::post('/dashboard/projects', [ProjectController::class, 'store'])->name('dashboard.projects.store');
Route::get('/dashboard/projects/{id}/edit', [ProjectController::class, 'edit'])->name('dashboard.projects.edit');
Route::put('/dashboard/projects/{id}', [ProjectController::class, 'update'])->name('dashboard.projects.update');
Route::delete('/dashboard/projects/{id}', [ProjectController::class, 'destroy'])->name('dashboard.projects.destroy');

// Projects routes (user's own projects - alternative paths)
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('projects.update');
Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');

// Opensource projects routes
Route::get('/opensource', [OpensourceProjectController::class, 'index'])->name('opensource.index');
Route::get('/opensource/create', [OpensourceProjectController::class, 'create'])->name('opensource.create');
Route::post('/opensource', [OpensourceProjectController::class, 'store'])->name('opensource.store');
Route::get('/opensource/{id}/edit', [OpensourceProjectController::class, 'edit'])->name('opensource.edit');
Route::put('/opensource/{id}', [OpensourceProjectController::class, 'update'])->name('opensource.update');
Route::delete('/opensource/{id}', [OpensourceProjectController::class, 'destroy'])->name('opensource.destroy');

// Admin authentication
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin dashboard
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

// Debug logs
Route::get('/debug-logs', [DebugLogController::class, 'index'])->name('debug.logs');
Route::post('/debug-logs/clear', [DebugLogController::class, 'clear'])->name('debug.logs.clear');

// Artisan command runner (guest accessible with passcode)
Route::get('/artisan', [ArtisanController::class, 'index'])->name('artisan.index');
Route::get('/artisan/authenticate', [ArtisanController::class, 'showAuthenticate'])->name('artisan.authenticate.show');
Route::post('/artisan/authenticate', [ArtisanController::class, 'authenticate'])->name('artisan.authenticate');
Route::post('/artisan/run', [ArtisanController::class, 'run'])->name('artisan.run');
Route::get('/artisan/refresh', [ArtisanController::class, 'refresh'])->name('artisan.refresh');
Route::post('/artisan/clear-logs', [ArtisanController::class, 'clearLogs'])->name('artisan.clear.logs');
Route::post('/artisan/logout', [ArtisanController::class, 'logout'])->name('artisan.logout');