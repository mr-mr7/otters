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
    /**
     * List of tasks with filter like filter[priority]=90
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
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

    /**
     * Create new task
     *
     * @param array $data
     * @return mixed
     */
    public function store(array $data): Task
    {
        return auth()->user()->tasks()->create($data);
    }

    /**
     * Show Task
     *
     * @param Task $task
     * @return Task
     */
    public function show(Task $task): Task
    {
        return $task;
    }

    /**
     * Update Task
     *
     * @param Task|int $task
     * @param array $data
     * @return Task
     */
    public function update(Task|int $task, array $data): Task
    {
        if (is_numeric($task)) $task = Task::query()->findOrFail($task);
        $task->update($data);
        return $task->fresh();
    }

    /**
     * Destroy Task
     *
     * @param Task $task
     * @return bool
     */
    public function destroy(Task $task): bool
    {
        return $task->delete();
    }
}
