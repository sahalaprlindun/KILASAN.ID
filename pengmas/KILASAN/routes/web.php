<?php

use App\Http\Controllers\Admin\ComplaintController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LegacyPageController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LegacyPageController::class, 'home'])->name('home');
Route::get('/about', [LegacyPageController::class, 'about'])->name('about');
Route::get('/about.html', [LegacyPageController::class, 'about']);
Route::get('/index.html', [LegacyPageController::class, 'home']);
Route::get('/form_page.html', [LegacyPageController::class, 'form']);
Route::get('/lapor', [LegacyPageController::class, 'form'])->name('reports.create');
Route::post('/lapor', [ReportController::class, 'store'])->name('reports.store');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/admin-login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::get('/login.html', [AuthController::class, 'showLogin']);

Route::middleware('guest')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
    Route::post('/admin-login', [AuthController::class, 'login'])->name('admin.login.store');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
Route::redirect('/dashboard', '/admin')->middleware('auth');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::get('/dashboard', DashboardController::class)->name('dashboard.alias');
    Route::get('/pengaduan', [ComplaintController::class, 'index'])->name('complaints.index');
    Route::get('/pengaduan/{complaint}', [ComplaintController::class, 'show'])->name('complaints.show');
    Route::get('/pengaduan/{complaint}/pdf', [ComplaintController::class, 'exportPDF'])->name('complaints.pdf'); // ← perbaiki ini
    Route::patch('/pengaduan/{complaint}/status', [ComplaintController::class, 'updateStatus'])->name('complaints.status');
    Route::delete('/pengaduan/{complaint}', [ComplaintController::class, 'destroy'])->name('complaints.destroy');
    Route::get('/profil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profil', [ProfileController::class, 'update'])->name('profile.update');

    Route::middleware('role:superadmin')->group(function () {
        Route::get('/petugas', [UserController::class, 'index'])->name('users.index');
        Route::post('/petugas', [UserController::class, 'store'])->name('users.store');
        Route::delete('/petugas/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');
    });
});
