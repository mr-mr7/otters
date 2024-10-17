<?php

use Illuminate\Support\Facades\Route;

Route::apiResource('tasks', \App\Http\Controllers\Api\V1\TaskController::class);
