<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('tasks', \App\Http\Controllers\Api\V1\TaskController::class);
});
Route::post('login', [\Laravel\Fortify\Http\Controllers\AuthenticatedSessionController::class, 'store']);
Route::post('register', [\Laravel\Fortify\Http\Controllers\RegisteredUserController::class, 'store']);
