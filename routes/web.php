<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth:web'])->group(function () {
    Route::get('tasks', \App\Livewire\Task\TaskManager::class)->name('tasks');
});
