<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// QR Code Authentication
Route::get('/qr-login/{uuid}', [AuthController::class, 'showQrLogin'])->name('qr.login');
Route::get('/set-password/{uuid}', [AuthController::class, 'showSetPassword'])->name('set-password');
Route::post('/set-password/{uuid}', [AuthController::class, 'setPassword']);

// Dashboard (Protected)
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

// Project Routes
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

// Admin Routes
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/projects', [AdminController::class, 'projects'])->name('admin.projects');
Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
Route::post('/admin/projects/{project}/approve', [AdminController::class, 'approveProject'])->name('admin.projects.approve');
Route::post('/admin/projects/{project}/reject', [AdminController::class, 'rejectProject'])->name('admin.projects.reject');