<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ConferenceSessionController as AdminSessionController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\SpeakerController;
use App\Http\Controllers\Admin\TrackController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ConferenceSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/api-demo', [HomeController::class, 'apiDemo'])->name('api.demo');

Route::get('/sessions', [ConferenceSessionController::class, 'index'])->name('sessions.index');
Route::get('/timetable', [ConferenceSessionController::class, 'timetable'])->name('sessions.timetable');
Route::get('/sessions/{session}', [ConferenceSessionController::class, 'show'])->name('sessions.show');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
});

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/sessions/{session}/register', [RegistrationController::class, 'store'])->name('registrations.store');
    Route::delete('/sessions/{session}/register', [RegistrationController::class, 'destroy'])->name('registrations.destroy');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('sessions', AdminSessionController::class);
    Route::resource('rooms', RoomController::class);
    Route::resource('speakers', SpeakerController::class);
    Route::resource('tracks', TrackController::class);
});
