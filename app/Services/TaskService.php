<?php

namespace App\Services;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TaskService
{
    public function index()
    {
        $tasks = QueryBuilder::for(\App\Models\Task::class)
            ->with('user')
            ->allowedFilters([
                'title', 'des',
                AllowedFilter::partial('user.name'),
                AllowedFilter::partial('user.lastname'),
                AllowedFilter::exact('priority'),
                AllowedFilter::exact('status'),
                AllowedFilter::scope('created_at_between'),
            ])
            ->orderByDesc('id');

        return $tasks->paginate(\request()->per_page ?? 25);
    }

    public function store($data)
    {
        return auth()->user()->tasks()->create($data);
    }

    public function show(Task $task)
    {
        return $task;
    }

    public function update(Task|int $task, $data)
    {
        if (is_numeric($task)) $task = Task::query()->findOrFail($task);
        $task->update($data);
        return $task->fresh();
    }

    public function destroy(Task $task)
    {
        return $task->delete();
    }
}
