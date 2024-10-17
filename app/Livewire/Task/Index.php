<?php

namespace App\Livewire\Task;

use App\Services\TaskService;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('لیست وظیفه ها')]
class Index extends Component
{
    private TaskService $taskService;

    public function boot(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function render()
    {
        $tasks = $this->taskService->index();
        return view('livewire.task.index', compact('tasks'));
    }
}
