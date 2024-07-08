<?php

use Illuminate\Support\Facades\Route;

// Backend

Route::get('/status/ping', [\App\Http\Controllers\StatusController::class, "ping"]);
Route::post('/status/foo', [\App\Http\Controllers\StatusController::class, "foo"]);

// General 1

Route::get("/workday/{country}/{date}", [\App\Http\Controllers\WorkdayController::class, "index"]);

// General 2

Route::get("/task-duration/expected-duration", [\App\Http\Controllers\TaskDurationController::class, "expectedDuration"]);
