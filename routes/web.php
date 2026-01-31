<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('projects.show');

// Authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// QR Registration routes
Route::get('/qr-register', [AuthController::class, 'showQrRegister'])->name('qr.register');
Route::post('/qr-register/verify', [AuthController::class, 'verifyQr'])->name('qr.verify');
Route::post('/qr-register/complete', [AuthController::class, 'completeQrRegistration'])->name('qr.complete');

// User dashboard routes
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
Route::get('/my-projects', [ProjectController::class, 'myProjects'])->name('my.projects');
Route::get('/my-projects/create', [ProjectController::class, 'create'])->name('projects.create');
Route::post('/my-projects', [ProjectController::class, 'store'])->name('projects.store');
Route::get('/my-projects/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
Route::put('/my-projects/{id}', [ProjectController::class, 'update'])->name('projects.update');
Route::delete('/my-projects/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');

// Admin routes
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
Route::get('/admin/projects', [AdminController::class, 'projects'])->name('admin.projects');