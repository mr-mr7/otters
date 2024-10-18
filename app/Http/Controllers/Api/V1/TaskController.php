<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\TaskStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\v1\TaskResource;
use App\Models\Task;
use App\Models\User;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class TaskController extends Controller
{
    public function __construct(private readonly TaskService $taskService)
    {

    }

    public function index()
    {
        return TaskResource::collection($this->taskService->index());
    }

    public function store(CreateTaskRequest $request)
    {
        return new TaskResource($this->taskService->store($request->only(['title', 'des', 'end_at', 'priority', 'status'])));
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        return new TaskResource($this->taskService->update($task, $request->only(['title', 'des', 'end_at', 'priority', 'status'])));
    }

    public function show(Task $task)
    {
        return new TaskResource($this->taskService->show($task));
    }

    public function destroy(Task $task)
    {
        return $this->taskService->destroy($task) ? Response::success() : Response::error();
    }
}
