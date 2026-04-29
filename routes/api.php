<?php

use App\Http\Controllers\Api\ScheduleApiController;
use Illuminate\Support\Facades\Route;

Route::get('/sessions', [ScheduleApiController::class, 'index'])->name('api.sessions.index');
Route::get('/sessions/{session}', [ScheduleApiController::class, 'show'])->name('api.sessions.show');
