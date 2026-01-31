<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OpensourceProjectController;
use App\Http\Controllers\DashboardController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/projects', [OpensourceProjectController::class, 'publicIndex'])->name('projects.index');
Route::get('/projects/{id}', [OpensourceProjectController::class, 'show'])->name('projects.show');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// User Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/dashboard/project', [DashboardController::class, 'storeProject'])->name('dashboard.project.store');
Route::delete('/dashboard/project/{id}', [DashboardController::class, 'deleteProject'])->name('dashboard.project.delete');

// Admin Authentication
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin Dashboard
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

// Admin Projects Management
Route::get('/admin/projects', [OpensourceProjectController::class, 'index'])->name('admin.projects.index');
Route::get('/admin/projects/create', [OpensourceProjectController::class, 'create'])->name('admin.projects.create');
Route::post('/admin/projects', [OpensourceProjectController::class, 'store'])->name('admin.projects.store');
Route::get('/admin/projects/{id}/edit', [OpensourceProjectController::class, 'edit'])->name('admin.projects.edit');
Route::put('/admin/projects/{id}', [OpensourceProjectController::class, 'update'])->name('admin.projects.update');
Route::delete('/admin/projects/{id}', [OpensourceProjectController::class, 'destroy'])->name('admin.projects.destroy');