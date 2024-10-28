<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Admin Routes List
Route::get('/admin', function () {
    return redirect()->route('admin.login');
});

Route::prefix('/admin')->group(function () {
    Route::get('/login', [LoginController::class, 'showAdminLoginForm'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'adminLogin']);
    Route::get('/register', [RegisterController::class, 'showAdminRegisterForm'])->name('admin.register');
    Route::post('/register', [RegisterController::class, 'adminRegister']);
    Route::post('/logout', [LoginController::class, 'adminLogout'])->name('admin.logout');
});

// Admin Login Page Route
Route::middleware('auth:admin')->group(function () {
    Route::name('admin.')->group(function () {
        Route::prefix('admin')->group(function () {

            //Admin Dashboard
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
            Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
            Route::post('/profile-update', [DashboardController::class, 'update'])->name('profile-update');

            Route::any('/projects',[ProjectController::class, 'index'])->name('projects');
            Route::prefix('project')->group(function () {
                Route::get('/create',[ProjectController::class, 'create'])->name('project.create');
                Route::post('/store',[ProjectController::class, 'store'])->name('project.store');
                Route::get('/edit/{id}',[ProjectController::class, 'edit'])->name('project.edit');
                Route::post('/update',[ProjectController::class, 'update'])->name('project.update');
                Route::get('/delete/{id}',[ProjectController::class, 'destroy'])->name('project.delete');
            });

            Route::any('/employees',[EmployeeController::class, 'index'])->name('employees');
            Route::prefix('employee')->group(function () {
                Route::get('/create',[EmployeeController::class, 'create'])->name('employee.create');
                Route::post('/store',[EmployeeController::class, 'store'])->name('employee.store');
                Route::get('/edit/{id}',[EmployeeController::class, 'edit'])->name('employee.edit');
                Route::post('/update',[EmployeeController::class, 'update'])->name('employee.update');
                Route::get('/delete/{id}',[EmployeeController::class, 'destroy'])->name('employee.delete');
            });

            Route::any('/users',[UserController::class, 'index'])->name('users');
            Route::prefix('user')->group(function () {
                Route::get('/create',[UserController::class, 'create'])->name('user.create');
                Route::post('/store',[UserController::class, 'store'])->name('user.store');
                Route::get('/edit/{id}',[UserController::class, 'edit'])->name('user.edit');
                Route::post('/update',[UserController::class, 'update'])->name('user.update');
                Route::get('/delete/{id}',[UserController::class, 'destroy'])->name('user.delete');
            });

        });
    });
});