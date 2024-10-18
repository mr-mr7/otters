<?php

namespace App\Livewire\Task;

use App\Services\TaskService;
use App\Traits\CustomAlert;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('لیست وظیفه ها')]
class Index extends Component
{
    use CustomAlert;

    private TaskService $taskService;

    protected $listeners = [
        '$refresh',
        'echo-private:tasks,TaskModified' => 'taskModified',
        'echo-private:tasks,TaskCreated' => 'taskCreated',
    ];

    public function boot(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function render()
    {
        $tasks = $this->taskService->index();
        return view('livewire.task.index', compact('tasks'));
    }

    public function taskModified($response)
    {
        $task = $response['task'];
        $this->successAlert("تسک `{$task['title']}` ویرایش شد");
    }

    public function taskCreated()
    {
        $this->successAlert('یک تسک جدید ایجاد شد');
    }
}
