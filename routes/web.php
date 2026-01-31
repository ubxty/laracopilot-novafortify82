<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\OpensourceProjectController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/projects', [OpensourceProjectController::class, 'publicIndex'])->name('projects.public');
Route::get('/projects/{id}', [OpensourceProjectController::class, 'publicShow'])->name('projects.show');

// Authentication Routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// User Dashboard Routes (Protected)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/projects', [ProjectController::class, 'index'])->name('dashboard.projects.index');
Route::get('/dashboard/projects/create', [ProjectController::class, 'create'])->name('dashboard.projects.create');
Route::post('/dashboard/projects', [ProjectController::class, 'store'])->name('dashboard.projects.store');
Route::get('/dashboard/projects/{id}/edit', [ProjectController::class, 'edit'])->name('dashboard.projects.edit');
Route::put('/dashboard/projects/{id}', [ProjectController::class, 'update'])->name('dashboard.projects.update');
Route::delete('/dashboard/projects/{id}', [ProjectController::class, 'destroy'])->name('dashboard.projects.destroy');

// Admin Routes
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/projects', [AdminController::class, 'projects'])->name('admin.projects');
Route::post('/admin/projects/{id}/approve', [AdminController::class, 'approveProject'])->name('admin.projects.approve');
Route::post('/admin/projects/{id}/reject', [AdminController::class, 'rejectProject'])->name('admin.projects.reject');
Route::post('/admin/projects/{id}/feature', [AdminController::class, 'featureProject'])->name('admin.projects.feature');
Route::delete('/admin/projects/{id}', [AdminController::class, 'deleteProject'])->name('admin.projects.delete');